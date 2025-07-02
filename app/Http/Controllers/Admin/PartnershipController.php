<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use Illuminate\Http\Request;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Log;

class PartnershipController extends Controller
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
        $partnerships = Partnership::orderBy('order', 'asc')->get();
        return view('backoffice.admin.partnerships.index', compact('partnerships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backoffice.admin.partnerships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'type' => ['required', 'string', 'in:sponsor,partner,media'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ], [
            'name.required' => 'O nome da parceria é obrigatório.',
            'website_url.url' => 'O URL do website deve ser válido.',
            'logo.image' => 'O arquivo deve ser uma imagem.',
            'logo.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg, gif, webp.',
            'logo.max' => 'A imagem não pode ter mais de 5MB.',
            'type.required' => 'O tipo de parceria é obrigatório.',
            'type.in' => 'O tipo deve ser: sponsor, partner ou media.',
        ]);

        try {
            $data = $request->only(['name', 'description', 'website_url', 'type', 'is_active', 'order']);
            $data['is_active'] = $request->has('is_active');
            $data['order'] = $request->order ?? 0;

            // Upload do logo se fornecido
            if ($request->hasFile('logo')) {
                $uploadResult = $this->imageUploadService->uploadImage($request->file('logo'), 'partnerships');

                if (!$uploadResult['success']) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['logo' => 'Erro no upload: ' . $uploadResult['error']]);
                }

                $data['logo_path'] = $uploadResult['path'];
            }

            Partnership::create($data);

            Log::info('Parceria criada com sucesso', [
                'name' => $data['name'],
                'type' => $data['type']
            ]);

            return redirect()->route('backoffice.admin.partnerships.index')
                ->with('success', 'Parceria criada com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao criar parceria', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Erro interno ao criar a parceria. Tente novamente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Partnership $partnership)
    {
        return view('backoffice.admin.partnerships.show', compact('partnership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partnership $partnership)
    {
        return view('backoffice.admin.partnerships.edit', compact('partnership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partnership $partnership)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'type' => ['required', 'string', 'in:sponsor,partner,media'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ], [
            'name.required' => 'O nome da parceria é obrigatório.',
            'website_url.url' => 'O URL do website deve ser válido.',
            'logo.image' => 'O arquivo deve ser uma imagem.',
            'logo.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg, gif, webp.',
            'logo.max' => 'A imagem não pode ter mais de 5MB.',
            'type.required' => 'O tipo de parceria é obrigatório.',
            'type.in' => 'O tipo deve ser: sponsor, partner ou media.',
        ]);

        try {
            $data = $request->only(['name', 'description', 'website_url', 'type', 'is_active', 'order']);
            $data['is_active'] = $request->has('is_active');
            $data['order'] = $request->order ?? 0;

            // Upload do logo se fornecido
            if ($request->hasFile('logo')) {
                $uploadResult = $this->imageUploadService->uploadImage($request->file('logo'), 'partnerships');

                if (!$uploadResult['success']) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['logo' => 'Erro no upload: ' . $uploadResult['error']]);
                }

                $data['logo_path'] = $uploadResult['path'];
            }

            $partnership->update($data);

            Log::info('Parceria atualizada com sucesso', [
                'partnership_id' => $partnership->id,
                'name' => $data['name']
            ]);

            return redirect()->route('backoffice.admin.partnerships.index')
                ->with('success', 'Parceria atualizada com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao atualizar parceria', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Erro interno ao atualizar a parceria. Tente novamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partnership $partnership)
    {
        try {
            $partnershipName = $partnership->name;
            $partnership->delete();

            Log::info('Parceria removida com sucesso', [
                'partnership_name' => $partnershipName
            ]);

            return redirect()->route('backoffice.admin.partnerships.index')
                ->with('success', 'Parceria removida com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao remover parceria', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withErrors(['general' => 'Erro interno ao remover a parceria. Tente novamente.']);
        }
    }
}
