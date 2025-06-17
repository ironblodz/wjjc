<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PhotoImage;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
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
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verificar se há imagens antes de criar o registro
        if (!$request->hasFile('images')) {
            return redirect()->back()->with('error', 'Please upload at least one image.');
        }

        // Processar a primeira imagem primeiro para obter o image_path
        $firstImage = $request->file('images')[0];
        $firstImagePath = $firstImage->store('photos', 'public');

        // Criar o registro principal da foto com o image_path já definido
        $photo = Photo::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'event_name' => $request->event_name,
            'description' => $request->description,
            'image_path' => $firstImagePath, // Definir o image_path com a primeira imagem
        ]);

        // Salvar a primeira imagem na tabela photo_images
        $photoImage = new PhotoImage([
            'photo_id' => $photo->id,
            'image_path' => $firstImagePath,
            'is_primary' => true, // A primeira imagem será a principal
        ]);
        $photoImage->save();

        // Processar as imagens restantes, se houver
        if (count($request->file('images')) > 1) {
            foreach ($request->file('images') as $index => $imageFile) {
                // Pular a primeira imagem, pois já foi processada
                if ($index === 0) continue;

                $imagePath = $imageFile->store('photos', 'public');

                // Salvar cada imagem associada à foto
                $photoImage = new PhotoImage([
                    'photo_id' => $photo->id,
                    'image_path' => $imagePath,
                    'is_primary' => false,
                ]);
                $photoImage->save();
            }
        }

        return redirect()->route('backoffice.admin.photos.index')->with('success', 'Photo gallery uploaded successfully.');
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
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        try {
            // Log para verificar se o método está sendo chamado
            \Illuminate\Support\Facades\Log::info('Update method called for photo ID: ' . $photo->id);
            \Illuminate\Support\Facades\Log::info('Request data:', $request->all());

            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'title' => 'required|string|max:255',
                'event_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'removed_images' => 'nullable|string', // Adicionando validação para removed_images
            ]);

            // Log após validação
            \Illuminate\Support\Facades\Log::info('Validation passed');

            // Atualizar os dados básicos da foto
            $photo->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'event_name' => $request->event_name,
                'description' => $request->description,
            ]);

            \Illuminate\Support\Facades\Log::info('Basic photo data updated');

            // Processar a imagem principal, se fornecida
            if ($request->hasFile('image')) {
                \Illuminate\Support\Facades\Log::info('Processing main image');

                // Excluir a imagem principal antiga
                if ($photo->image_path) {
                    Storage::disk('public')->delete($photo->image_path);
                }

                $imagePath = $request->file('image')->store('photos', 'public');
                $photo->update(['image_path' => $imagePath]);

                // Atualizar ou criar uma imagem primária na galeria
                $primaryImage = $photo->images()->where('is_primary', true)->first();
                if ($primaryImage) {
                    Storage::disk('public')->delete($primaryImage->image_path);
                    $primaryImage->update(['image_path' => $imagePath]);
                    \Illuminate\Support\Facades\Log::info('Updated primary image');
                } else {
                    $photo->images()->create([
                        'image_path' => $imagePath,
                        'is_primary' => true
                    ]);
                    \Illuminate\Support\Facades\Log::info('Created new primary image');
                }
            }

            // Adicionar novas imagens à galeria
            if ($request->hasFile('gallery_images')) {
                \Illuminate\Support\Facades\Log::info('Processing gallery images');
                $hasPrimary = $photo->images()->where('is_primary', true)->exists();

                foreach ($request->file('gallery_images') as $index => $imageFile) {
                    $imagePath = $imageFile->store('photos', 'public');

                    // Salvar cada nova imagem
                    $photoImage = new PhotoImage([
                        'photo_id' => $photo->id,
                        'image_path' => $imagePath,
                        'is_primary' => !$hasPrimary && $index === 0, // Primeira imagem é primária apenas se não existir uma
                    ]);
                    $photoImage->save();
                    \Illuminate\Support\Facades\Log::info('Added new gallery image: ' . $imagePath);

                    // Se não houver imagem primária e esta for a primeira, atualiza o campo image_path
                    if (!$hasPrimary && $index === 0) {
                        $photo->update(['image_path' => $imagePath]);
                        $hasPrimary = true;
                        \Illuminate\Support\Facades\Log::info('Set new image as primary: ' . $imagePath);
                    }
                }
            }

            // Processar imagens removidas (se houver)
            if ($request->has('removed_images') && !empty($request->removed_images)) {
                \Illuminate\Support\Facades\Log::info('Processing removed images: ' . $request->removed_images);
                $removedIds = explode(',', $request->removed_images);

                foreach ($removedIds as $imageId) {
                    if (!empty($imageId)) {
                        $image = PhotoImage::find($imageId);
                        if ($image) {
                            Storage::disk('public')->delete($image->image_path);
                            $image->delete();
                            \Illuminate\Support\Facades\Log::info('Deleted image ID: ' . $imageId);
                        }
                    }
                }
            }

            \Illuminate\Support\Facades\Log::info('Update completed, redirecting to index');
            return redirect()->route('backoffice.admin.photos.index')
                ->with('success', 'Photo gallery updated successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error in update method: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        // Excluir todas as imagens associadas
        foreach ($photo->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // Excluir a imagem principal se existir
        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }

        $photo->delete();

        return redirect()->route('backoffice.admin.photos.index')->with('success', 'Photo gallery deleted successfully');
    }

    public function setPrimaryImage(Request $request, Photo $photo, $imageId)
    {
        // Remover o status de primária de todas as imagens desta foto
        $photo->images()->update(['is_primary' => false]);

        // Definir a nova imagem primária
        $newPrimary = PhotoImage::findOrFail($imageId);
        $newPrimary->update(['is_primary' => true]);

        // Atualizar o campo image_path da foto principal
        $photo->update(['image_path' => $newPrimary->image_path]);

        return redirect()->back()->with('success', 'Primary image updated successfully');
    }

    public function deleteImage($imageId)
    {
        try {
            $image = PhotoImage::findOrFail($imageId);
            $photoId = $image->photo_id;
            $photo = Photo::findOrFail($photoId);

            // Verificar se é a imagem primária
            $isPrimary = $image->is_primary;

            // Excluir a imagem do armazenamento
            Storage::disk('public')->delete($image->image_path);

            // Excluir o registro do banco de dados
            $image->delete();

            // Se era a imagem primária, definir outra como primária
            if ($isPrimary) {
                $newPrimary = $photo->images()->first();
                if ($newPrimary) {
                    $newPrimary->update(['is_primary' => true]);
                    $photo->update(['image_path' => $newPrimary->image_path]);
                } else {
                    // Se não houver mais imagens, limpar o image_path
                    $photo->update(['image_path' => null]);
                }
            }

            // Verificar se a requisição é AJAX
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            }

            return redirect()->route('backoffice.admin.photos.edit', $photoId)
                ->with('success', 'Image deleted successfully');
        } catch (\Exception $e) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting image: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Error deleting image: ' . $e->getMessage());
        }
    }
}
