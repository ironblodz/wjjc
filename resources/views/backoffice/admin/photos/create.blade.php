@extends('layouts.backoffice')

@section('title', 'Novo Evento')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center">
            <a href="{{ route('backoffice.admin.photos.index') }}"
               class="mr-4 p-2 text-gray-400 hover:text-gray-600 transition-colors duration-200">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Novo Evento</h2>
                <p class="mt-1 text-sm text-gray-600">Crie um novo evento com sua galeria de fotos</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Informações do Evento</h3>
        </div>

        <form action="{{ route('backoffice.admin.photos.store') }}" method="POST" enctype="multipart/form-data" class="p-6" id="photo-form">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Category Field -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tags mr-2 text-purple-500"></i>
                            Categoria
                        </label>
                        <select class="w-full px-4 py-3 border @error('category_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200"
                                id="category_id" name="category_id" required aria-invalid="@error('category_id')true@enderror" aria-describedby="category-error">
                            <option value="">Selecione uma categoria</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center" id="category-error">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2 text-blue-500"></i>
                            Título do Evento
                        </label>
                        <input type="text"
                               class="w-full px-4 py-3 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                               id="title" name="title" value="{{ old('title') }}"
                               placeholder="Ex: Casamento João e Maria"
                               required aria-invalid="@error('title')true@enderror" aria-describedby="title-error">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center" id="title-error">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Event Name Field -->
                    <div>
                        <label for="event_name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-2 text-green-500"></i>
                            Nome do Evento
                        </label>
                        <input type="text"
                               class="w-full px-4 py-3 border @error('event_name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200"
                               id="event_name" name="event_name" value="{{ old('event_name') }}"
                               placeholder="Ex: Casamento"
                               required aria-invalid="@error('event_name')true@enderror" aria-describedby="event-name-error">
                        @error('event_name')
                            <p class="mt-2 text-sm text-red-600 flex items-center" id="event-name-error">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-orange-500"></i>
                            Descrição
                        </label>
                        <textarea class="w-full px-4 py-3 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200"
                                  id="description" name="description" rows="4"
                                  placeholder="Descreva o evento..." aria-invalid="@error('description')true@enderror" aria-describedby="description-error">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center" id="description-error">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Cover Image Field -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-2 text-red-500"></i>
                            Imagem de Capa
                        </label>
                        <div class="border-2 border-dashed @error('image') border-red-500 @else border-gray-300 @enderror rounded-lg p-6 text-center hover:border-gray-400 transition-colors duration-200">
                            <input type="file"
                                   class="hidden"
                                   id="image" name="image"
                                   accept="image/*" required>
                            <label for="image" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="text-sm text-gray-600" id="image-label">Clique para selecionar a imagem de capa</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG, GIF, WEBP até 5MB</p>
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Gallery Images Field -->
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-images mr-2 text-indigo-500"></i>
                            Galeria de Fotos
                        </label>
                        <div class="border-2 border-dashed @error('images.*') border-red-500 @else border-gray-300 @enderror rounded-lg p-6 text-center hover:border-gray-400 transition-colors duration-200">
                            <input type="file"
                                   class="hidden"
                                   id="images" name="images[]"
                                   accept="image/*" multiple required>
                            <label for="images" class="cursor-pointer">
                                <i class="fas fa-images text-4xl text-gray-400 mb-4"></i>
                                <p class="text-sm text-gray-600" id="images-label">Clique para selecionar as fotos da galeria</p>
                                <p class="text-xs text-gray-500 mt-1">Você pode selecionar múltiplas imagens</p>
                            </label>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            A primeira imagem será usada como capa do evento.
                        </p>
                        @error('images.*')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Preview Section -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-eye mr-2 text-gray-500"></i>
                            Dicas para uma boa galeria
                        </h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                Use imagens de alta qualidade
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                Mantenha proporções consistentes
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                Organize as fotos em ordem cronológica
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 mt-6">
                <a href="{{ route('backoffice.admin.photos.index') }}"
                   class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </a>
                <button type="submit" id="submit-btn"
                        class="btn-primary px-6 py-3 text-white rounded-lg hover:shadow-lg transition-all duration-200 flex items-center">
                    <span id="btn-text"><i class="fas fa-upload mr-2"></i>Criar Evento</span>
                    <span id="btn-loading" class="hidden"><i class="fas fa-spinner fa-spin mr-2"></i>Criando...</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // File input preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const label = document.getElementById('image-label');
            label.textContent = `Imagem selecionada: ${file.name}`;
            label.classList.add('text-green-600');
        }
    });

    document.getElementById('images').addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            const label = document.getElementById('images-label');
            label.textContent = `${files.length} imagens selecionadas`;
            label.classList.add('text-green-600');
        }
    });

    // Foco automático no primeiro erro
    window.addEventListener('DOMContentLoaded', function() {
        const errorField = document.querySelector('.border-red-500');
        if (errorField) errorField.focus();
    });

    // Botão com loading ao enviar
    document.getElementById('photo-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        document.getElementById('btn-text').classList.add('hidden');
        document.getElementById('btn-loading').classList.remove('hidden');
    });
</script>
@endpush
@endsection
