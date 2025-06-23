<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PhotoImage;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Log;

class PhotoController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::with('category')->get();
        return view('backoffice.admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backoffice.admin.photos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'event_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // 5MB max
        ], [
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'A categoria selecionada não existe.',
            'title.required' => 'O título do evento é obrigatório.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',
            'event_name.required' => 'O nome do evento é obrigatório.',
            'event_name.max' => 'O nome do evento não pode ter mais de 255 caracteres.',
            'description.max' => 'A descrição não pode ter mais de 1000 caracteres.',
            'images.required' => 'É necessário fazer upload de pelo menos uma imagem.',
            'images.*.required' => 'Todas as imagens são obrigatórias.',
            'images.*.image' => 'O arquivo deve ser uma imagem válida.',
            'images.*.mimes' => 'As imagens devem ser nos formatos: JPEG, PNG, JPG, GIF ou WEBP.',
            'images.*.max' => 'Cada imagem não pode ter mais de 5MB.',
        ]);

        // Verificar se há imagens antes de criar o registro
        if (!$request->hasFile('images')) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['images' => 'É necessário fazer upload de pelo menos uma imagem.']);
        }

        try {
            // Upload das imagens usando o serviço
            $uploadResult = $this->imageUploadService->uploadMultipleImages($request->file('images'));

            if (!$uploadResult['success']) {
                $errorMessages = collect($uploadResult['errors'])->pluck('error')->implode(', ');
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['images' => 'Erro no upload: ' . $errorMessages]);
            }

            // Criar o registro principal da foto com a primeira imagem
            $firstImage = $uploadResult['uploaded'][0];
            $photo = Photo::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'event_name' => $request->event_name,
                'description' => $request->description,
                'image_path' => $firstImage['path'],
            ]);

            // Salvar todas as imagens na tabela photo_images
            foreach ($uploadResult['uploaded'] as $index => $uploadedImage) {
                $photoImage = new PhotoImage([
                    'photo_id' => $photo->id,
                    'image_path' => $uploadedImage['path'],
                    'is_primary' => $index === 0, // A primeira imagem será a principal
                ]);
                $photoImage->save();
            }

            Log::info('Galeria de fotos criada com sucesso', [
                'photo_id' => $photo->id,
                'title' => $photo->title,
                'images_count' => count($uploadResult['uploaded'])
            ]);

            return redirect()->route('backoffice.admin.photos.index')
                ->with('success', 'Galeria de fotos criada com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao criar galeria de fotos', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Erro interno ao criar a galeria. Tente novamente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return view('backoffice.admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        $categories = Category::all();
        $photo->load('images');
        return view('backoffice.admin.photos.edit', compact('photo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        try {
            $request->validate([
                'category_id' => ['required', 'exists:categories,id'],
                'title' => ['required', 'string', 'max:255'],
                'event_name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:1000'],
                'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
                'gallery_images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
                'removed_images' => ['nullable', 'string'],
            ], [
                'category_id.required' => 'A categoria é obrigatória.',
                'category_id.exists' => 'A categoria selecionada não existe.',
                'title.required' => 'O título do evento é obrigatório.',
                'title.max' => 'O título não pode ter mais de 255 caracteres.',
                'event_name.required' => 'O nome do evento é obrigatório.',
                'event_name.max' => 'O nome do evento não pode ter mais de 255 caracteres.',
                'description.max' => 'A descrição não pode ter mais de 1000 caracteres.',
                'image.image' => 'O arquivo deve ser uma imagem válida.',
                'image.mimes' => 'A imagem deve ser nos formatos: JPEG, PNG, JPG, GIF ou WEBP.',
                'image.max' => 'A imagem não pode ter mais de 5MB.',
                'gallery_images.*.image' => 'O arquivo deve ser uma imagem válida.',
                'gallery_images.*.mimes' => 'As imagens devem ser nos formatos: JPEG, PNG, JPG, GIF ou WEBP.',
                'gallery_images.*.max' => 'Cada imagem não pode ter mais de 5MB.',
            ]);

            // Atualizar os dados básicos da foto
            $photo->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'event_name' => $request->event_name,
                'description' => $request->description,
            ]);

            // Processar a imagem principal, se fornecida
            if ($request->hasFile('image')) {
                $uploadResult = $this->imageUploadService->uploadImage($request->file('image'));

                if ($uploadResult['success']) {
                    // Excluir a imagem principal antiga
                    if ($photo->image_path) {
                        $this->imageUploadService->deleteImage($photo->image_path);
                    }

                    $photo->update(['image_path' => $uploadResult['path']]);

                    // Atualizar ou criar uma imagem primária na galeria
                    $primaryImage = $photo->images()->where('is_primary', true)->first();
                    if ($primaryImage) {
                        $this->imageUploadService->deleteImage($primaryImage->image_path);
                        $primaryImage->update(['image_path' => $uploadResult['path']]);
                    } else {
                        $photo->images()->create([
                            'image_path' => $uploadResult['path'],
                            'is_primary' => true
                        ]);
                    }
                }
            }

            // Adicionar novas imagens à galeria
            if ($request->hasFile('gallery_images')) {
                $uploadResult = $this->imageUploadService->uploadMultipleImages($request->file('gallery_images'));

                if ($uploadResult['success']) {
                    $hasPrimary = $photo->images()->where('is_primary', true)->exists();

                    foreach ($uploadResult['uploaded'] as $index => $uploadedImage) {
                        // Salvar cada nova imagem
                        $photoImage = new PhotoImage([
                            'photo_id' => $photo->id,
                            'image_path' => $uploadedImage['path'],
                            'is_primary' => !$hasPrimary && $index === 0,
                        ]);
                        $photoImage->save();

                        // Se não houver imagem primária e esta for a primeira, atualiza o campo image_path
                        if (!$hasPrimary && $index === 0) {
                            $photo->update(['image_path' => $uploadedImage['path']]);
                            $hasPrimary = true;
                        }
                    }
                }
            }

            // Processar imagens removidas
            if ($request->has('removed_images') && !empty($request->removed_images)) {
                $removedIds = explode(',', $request->removed_images);

                foreach ($removedIds as $imageId) {
                    if (!empty($imageId)) {
                        $image = PhotoImage::find($imageId);
                        if ($image) {
                            $this->imageUploadService->deleteImage($image->image_path);
                            $image->delete();
                        }
                    }
                }
            }

            Log::info('Galeria de fotos atualizada com sucesso', [
                'photo_id' => $photo->id,
                'title' => $photo->title
            ]);

            return redirect()->route('backoffice.admin.photos.index')
                ->with('success', 'Galeria de fotos atualizada com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao atualizar galeria de fotos', [
                'photo_id' => $photo->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Ocorreu um erro ao atualizar a galeria: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        try {
            // Excluir todas as imagens associadas
            foreach ($photo->images as $image) {
                $this->imageUploadService->deleteImage($image->image_path);
                $image->delete();
            }

            // Excluir a imagem principal se existir
            if ($photo->image_path) {
                $this->imageUploadService->deleteImage($photo->image_path);
            }

            $photo->delete();

            Log::info('Galeria de fotos excluída com sucesso', [
                'photo_id' => $photo->id,
                'title' => $photo->title
            ]);

            return redirect()->route('backoffice.admin.photos.index')
                ->with('success', 'Galeria de fotos excluída com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao excluir galeria de fotos', [
                'photo_id' => $photo->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Erro ao excluir a galeria: ' . $e->getMessage());
        }
    }

    public function setPrimaryImage(Request $request, Photo $photo, $imageId)
    {
        try {
            // Remover o status de primária de todas as imagens desta foto
            $photo->images()->update(['is_primary' => false]);

            // Definir a nova imagem primária
            $newPrimary = PhotoImage::findOrFail($imageId);
            $newPrimary->update(['is_primary' => true]);

            // Atualizar o campo image_path da foto principal
            $photo->update(['image_path' => $newPrimary->image_path]);

            Log::info('Imagem principal atualizada', [
                'photo_id' => $photo->id,
                'image_id' => $imageId
            ]);

            return redirect()->back()
                ->with('success', 'Imagem principal atualizada com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao atualizar imagem principal', [
                'photo_id' => $photo->id,
                'image_id' => $imageId,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Erro ao atualizar imagem principal: ' . $e->getMessage());
        }
    }

    public function deleteImage($imageId)
    {
        try {
            $image = PhotoImage::findOrFail($imageId);
            $photoId = $image->photo_id;
            $photo = Photo::findOrFail($photoId);

            // Verificar se é a imagem primária
            $isPrimary = $image->is_primary;

            // Excluir a imagem do storage
            $this->imageUploadService->deleteImage($image->image_path);

            // Excluir o registro do banco de dados
            $image->delete();

            // Se era a imagem primária, definir outra como primária
            if ($isPrimary) {
                $newPrimary = $photo->images()->first();
                if ($newPrimary) {
                    $newPrimary->update(['is_primary' => true]);
                    $photo->update(['image_path' => $newPrimary->image_path]);
                } else {
                    // Se não há mais imagens, limpar o image_path
                    $photo->update(['image_path' => null]);
                }
            }

            Log::info('Imagem da galeria excluída', [
                'image_id' => $imageId,
                'photo_id' => $photoId
            ]);

            return redirect()->back()
                ->with('success', 'Imagem excluída com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao excluir imagem da galeria', [
                'image_id' => $imageId,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Erro ao excluir a imagem: ' . $e->getMessage());
        }
    }
}
