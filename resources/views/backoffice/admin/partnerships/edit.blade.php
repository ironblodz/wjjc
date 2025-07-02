@extends('layouts.backoffice')

@section('title', trans('backoffice.partnerships.edit'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        <i class="fas fa-edit mr-3 text-purple-600"></i>
                        {{ trans('backoffice.partnerships.edit') }}
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Editar parceria: {{ $partnership->name }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('backoffice.admin.partnerships.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form action="{{ route('backoffice.admin.partnerships.update', $partnership) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-8">
                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-purple-600"></i>
                            Informações Básicas
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ trans('backoffice.partnerships.fields.name') }} *
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $partnership->name) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('name') border-red-500 @enderror"
                                       placeholder="Nome da parceria">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ trans('backoffice.partnerships.fields.type') }} *
                                </label>
                                <select name="type"
                                        id="type"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('type') border-red-500 @enderror">
                                    <option value="">Selecione o tipo</option>
                                    <option value="sponsor" {{ old('type', $partnership->type) == 'sponsor' ? 'selected' : '' }}>
                                        {{ trans('backoffice.partnerships.types.sponsor') }}
                                    </option>
                                    <option value="partner" {{ old('type', $partnership->type) == 'partner' ? 'selected' : '' }}>
                                        {{ trans('backoffice.partnerships.types.partner') }}
                                    </option>
                                    <option value="media" {{ old('type', $partnership->type) == 'media' ? 'selected' : '' }}>
                                        {{ trans('backoffice.partnerships.types.media') }}
                                    </option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ trans('backoffice.partnerships.fields.description') }}
                            </label>
                            <textarea name="description"
                                      id="description"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('description') border-red-500 @enderror"
                                      placeholder="Descrição da parceria">{{ old('description', $partnership->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website URL -->
                        <div class="mt-6">
                            <label for="website_url" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ trans('backoffice.partnerships.fields.website_url') }}
                            </label>
                            <input type="url"
                                   name="website_url"
                                   id="website_url"
                                   value="{{ old('website_url', $partnership->website_url) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('website_url') border-red-500 @enderror"
                                   placeholder="https://exemplo.com">
                            @error('website_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-image mr-2 text-purple-600"></i>
                            Logo da Parceria
                        </h3>

                        <!-- Current Logo -->
                        @if($partnership->logo_path)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Logo Atual</label>
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $partnership->logo_path) }}"
                                         alt="{{ $partnership->name }} Logo"
                                         class="h-20 w-auto rounded-lg shadow-sm border border-gray-200">
                                    <div>
                                        <p class="text-sm text-gray-600">Logo atual da parceria</p>
                                        <p class="text-xs text-gray-500">Selecione uma nova imagem para substituir</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-purple-400 transition-colors">
                            <div class="space-y-4">
                                <div class="mx-auto h-16 w-16 text-gray-400">
                                    <i class="fas fa-cloud-upload-alt text-4xl"></i>
                                </div>
                                <div>
                                    <label for="logo" class="cursor-pointer">
                                        <span class="text-lg font-medium text-gray-900">
                                            {{ $partnership->logo_path ? 'Clique para alterar o logo' : 'Clique para selecionar um logo' }}
                                        </span>
                                        <p class="text-sm text-gray-500 mt-1">PNG, JPG, GIF ou WEBP até 5MB</p>
                                    </label>
                                    <input type="file"
                                           name="logo"
                                           id="logo"
                                           accept="image/*"
                                           class="hidden"
                                           onchange="previewImage(this)">
                                </div>
                            </div>

                            <!-- Image Preview -->
                            <div id="image-preview" class="mt-4 hidden">
                                <img id="preview-img" src="" alt="Preview" class="mx-auto max-h-32 max-w-full rounded-lg shadow-sm">
                                <button type="button" onclick="removeImage()" class="mt-2 text-sm text-red-600 hover:text-red-800">
                                    <i class="fas fa-times mr-1"></i>Remover nova imagem
                                </button>
                            </div>
                        </div>
                        @error('logo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Settings -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-cog mr-2 text-purple-600"></i>
                            Configurações
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Active Status -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', $partnership->is_active) ? 'checked' : '' }}
                                           class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm font-medium text-gray-700">
                                        {{ trans('backoffice.partnerships.fields.is_active') }}
                                    </span>
                                </label>
                                <p class="mt-1 text-sm text-gray-500">Marque para ativar esta parceria</p>
                            </div>

                            <!-- Order -->
                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ trans('backoffice.partnerships.fields.order') }}
                                </label>
                                <input type="number"
                                       name="order"
                                       id="order"
                                       value="{{ old('order', $partnership->order) }}"
                                       min="0"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('order') border-red-500 @enderror"
                                       placeholder="0">
                                <p class="mt-1 text-sm text-gray-500">Ordem de exibição (menor número aparece primeiro)</p>
                                @error('order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-8 py-6 flex items-center justify-between">
                    <a href="{{ route('backoffice.admin.partnerships.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        {{ trans('backoffice.partnerships.cancel') }}
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <i class="fas fa-save mr-2"></i>
                        {{ trans('backoffice.partnerships.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    const input = document.getElementById('logo');
    const preview = document.getElementById('image-preview');

    input.value = '';
    preview.classList.add('hidden');
}
</script>
@endsection
