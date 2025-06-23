@extends('layouts.backoffice')

@section('title', 'Novo Evento')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center">
            <a href="{{ route('backoffice.admin.photos.index') }}"
               class="mr-6 p-3 text-gray-400 hover:text-gray-600 transition-all duration-300 hover:bg-gray-100 rounded-xl"
               aria-label="Voltar para lista de eventos">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-plus mr-3 text-green-500"></i>
                    Novo Evento
                </h2>
                <p class="text-lg text-gray-600">Adicione um novo evento com suas fotos e informações</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-camera mr-3 text-blue-500"></i>
                Informações do Evento
            </h3>
        </div>

        <form action="{{ route('backoffice.admin.photos.store') }}" method="POST" enctype="multipart/form-data" class="p-8" id="photo-form" novalidate>
            @csrf

            <div class="space-y-8">
                <!-- Category Field -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                    <label for="category_id" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-tag mr-3 text-blue-500"></i>
                        Categoria <span class="text-red-500" aria-label="Campo obrigatório">*</span>
                    </label>
                    <select name="category_id" id="category_id"
                            class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('category_id') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm"
                            required aria-invalid="{{ $errors->has('category_id') ? 'true' : 'false' }}" aria-describedby="category-error category-help">
                        <option value="">Selecione uma categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-3 text-sm text-gray-600 flex items-center" id="category-help">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Escolha a categoria que melhor representa este evento.
                    </p>
                    @if($errors->has('category_id'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="category-error" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>

                <!-- Event Name Field -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                    <label for="event_name" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-calendar mr-3 text-green-500"></i>
                        Nome do Evento <span class="text-red-500" aria-label="Campo obrigatório">*</span>
                    </label>
                    <input type="text"
                           name="event_name"
                           id="event_name"
                           value="{{ old('event_name') }}"
                           class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('event_name') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm"
                           placeholder="Ex: Casamento João e Maria, Aniversário 50 anos..."
                           required
                           minlength="3"
                           maxlength="255"
                           aria-invalid="{{ $errors->has('event_name') ? 'true' : 'false' }}"
                           aria-describedby="event-name-error event-name-help"
                           autofocus>
                    <p class="mt-3 text-sm text-gray-600 flex items-center" id="event-name-help">
                        <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                        Use um nome descritivo que identifique claramente o evento (mínimo 3 caracteres).
                    </p>
                    @if($errors->has('event_name'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="event-name-error" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('event_name') }}
                        </p>
                    @endif
                </div>

                <!-- Title Field -->
                <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-2xl p-6 border border-teal-100">
                    <label for="title" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-heading mr-3 text-teal-500"></i>
                        Título do Evento <span class="text-red-500" aria-label="Campo obrigatório">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title') }}"
                           class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-teal-500 focus:border-teal-500 transition-all duration-300 shadow-sm"
                           placeholder="Ex: Casamento João e Maria, Aniversário 50 anos..."
                           required
                           minlength="3"
                           maxlength="255"
                           aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}"
                           aria-describedby="title-error title-help">
                    <p class="mt-3 text-sm text-gray-600 flex items-center" id="title-help">
                        <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                        Título que será exibido na galeria e listagens (mínimo 3 caracteres).
                    </p>
                    @if($errors->has('title'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="title-error" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>

                <!-- Description Field -->
                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-2xl p-6 border border-orange-100">
                    <label for="description" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-align-left mr-3 text-orange-500"></i>
                        Descrição (Opcional)
                    </label>
                    <textarea class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 shadow-sm resize-none"
                              name="description"
                              id="description"
                              rows="4"
                              maxlength="1000"
                              placeholder="Descreva o evento..."
                              aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}"
                              aria-describedby="description-error description-help">{{ old('description') }}</textarea>
                    <div class="flex justify-between items-center mt-3">
                        <p class="text-sm text-gray-600 flex items-center" id="description-help">
                            <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                            Uma descrição detalhada ajuda a contextualizar melhor o evento.
                        </p>
                        <span class="text-xs text-gray-500" id="description-counter">0/1000</span>
                    </div>
                    @if($errors->has('description'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="description-error" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>

                <!-- Main Image Upload -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-image mr-3 text-purple-500"></i>
                        Imagem Principal <span class="text-red-500" aria-label="Campo obrigatório">*</span>
                    </label>
                    <div class="border-2 border-dashed {{ $errors->has('images.*') ? 'border-red-500' : 'border-gray-300' }} rounded-xl p-8 text-center hover:border-gray-400 transition-all duration-300 bg-white">
                        <input type="file" name="images[]" id="main_image" accept="image/*" class="hidden" required aria-describedby="main-image-error main-image-help">
                        <label for="main_image" class="cursor-pointer">
                            <div class="space-y-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto">
                                    <i class="fas fa-cloud-upload-alt text-white text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900">Clique para selecionar uma imagem</p>
                                    <p class="text-sm text-gray-600 mt-1">PNG, JPG, JPEG até 5MB</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    <p class="mt-3 text-sm text-gray-600 flex items-center" id="main-image-help">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Esta será a imagem principal do evento, exibida em destaque. Formatos aceitos: PNG, JPG, JPEG. Tamanho máximo: 5MB.
                    </p>
                    @if($errors->has('images.*'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="main-image-error" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('images.*') }}
                        </p>
                    @endif
                </div>

                <!-- Main Image Preview -->
                <div id="main-image-preview" class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100 hidden">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-eye mr-3 text-purple-500"></i>
                        Preview da Imagem Principal
                    </label>
                    <div class="flex items-center justify-center">
                        <div class="relative">
                            <img id="main-preview-img" src="" alt="Preview da imagem principal"
                                 class="max-w-full h-64 object-cover rounded-xl border-2 border-purple-200 shadow-lg">
                            <button type="button" onclick="removeMainImage()"
                                    class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-all duration-300">
                                <i class="fas fa-times text-sm"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-gray-600 text-center">
                        <i class="fas fa-check-circle mr-2 text-green-500"></i>
                        Imagem principal selecionada com sucesso!
                    </p>
                </div>

                <!-- Gallery Images Upload -->
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-images mr-3 text-indigo-500"></i>
                        Galeria de Fotos (Opcional)
                    </label>
                    <div class="border-2 border-dashed {{ $errors->has('images.*') ? 'border-red-500' : 'border-gray-300' }} rounded-xl p-8 text-center hover:border-gray-400 transition-all duration-300 bg-white">
                        <input type="file" name="images[]" id="images" accept="image/*" class="hidden" multiple aria-describedby="images-error images-help">
                        <label for="images" class="cursor-pointer">
                            <div class="space-y-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-full flex items-center justify-center mx-auto">
                                    <i class="fas fa-images text-white text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900">Clique para selecionar múltiplas imagens</p>
                                    <p class="text-sm text-gray-600 mt-1">PNG, JPG, JPEG até 5MB cada</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    <p class="mt-3 text-sm text-gray-600 flex items-center" id="images-help">
                        <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                        Você pode selecionar várias imagens para criar uma galeria completa do evento. As imagens serão marcadas como "Nova" por 7 dias.
                    </p>
                    @if($errors->has('images.*'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="images-error" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('images.*') }}
                        </p>
                    @endif
                </div>

                <!-- Gallery Images Preview -->
                <div id="gallery-preview" class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100 hidden">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-images mr-3 text-indigo-500"></i>
                        Preview da Galeria (<span id="gallery-count">0</span> fotos)
                    </label>
                    <div id="gallery-preview-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        <!-- Preview images will be inserted here -->
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            <span id="gallery-status">Imagens selecionadas com sucesso!</span>
                        </p>
                        <button type="button" onclick="clearGallery()"
                                class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all duration-300 text-sm font-semibold">
                            <i class="fas fa-trash mr-2"></i>
                            Limpar Galeria
                        </button>
                    </div>
                </div>

                <!-- Tips Section -->
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-8 border border-yellow-200">
                    <h4 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-lightbulb mr-3 text-yellow-500"></i>
                        Dicas para um Bom Evento
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900 mb-1">Nome Descritivo</h5>
                                <p class="text-sm text-gray-600">Use nomes que identifiquem claramente o evento</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900 mb-1">Categoria Adequada</h5>
                                <p class="text-sm text-gray-600">Escolha a categoria que melhor representa o evento</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900 mb-1">Imagem Principal</h5>
                                <p class="text-sm text-gray-600">Escolha uma imagem que represente bem o evento</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900 mb-1">Galeria Completa</h5>
                                <p class="text-sm text-gray-600">Adicione várias fotos para mostrar diferentes momentos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-gray-200">
                    <a href="{{ route('backoffice.admin.photos.index') }}"
                       class="w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200 text-center font-semibold">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" id="submit-btn"
                            class="w-full sm:w-auto btn-primary px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
                        <span id="btn-text">
                            <i class="fas fa-save mr-3 text-lg"></i>
                            Criar Evento
                        </span>
                        <span id="btn-loading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-3 text-lg"></i>
                            Salvando...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for description
    const descriptionTextarea = document.getElementById('description');
    const descriptionCounter = document.getElementById('description-counter');

    if (descriptionTextarea && descriptionCounter) {
        function updateCounter() {
            const length = descriptionTextarea.value.length;
            descriptionCounter.textContent = `${length}/1000`;

            if (length > 900) {
                descriptionCounter.classList.add('text-red-500');
            } else {
                descriptionCounter.classList.remove('text-red-500');
            }
        }

        descriptionTextarea.addEventListener('input', updateCounter);
        updateCounter(); // Initial count
    }

    // File validation and preview
    const imageInput = document.getElementById('main_image');
    const galleryInput = document.getElementById('images');
    const mainPreview = document.getElementById('main-image-preview');
    const mainPreviewImg = document.getElementById('main-preview-img');
    const galleryPreview = document.getElementById('gallery-preview');
    const galleryPreviewGrid = document.getElementById('gallery-preview-grid');
    const galleryCount = document.getElementById('gallery-count');
    const galleryStatus = document.getElementById('gallery-status');

    function validateFile(file, maxSize = 5 * 1024 * 1024) {
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

        if (!allowedTypes.includes(file.type)) {
            return 'Formato de arquivo não suportado. Use apenas PNG, JPG, JPEG, GIF ou WEBP.';
        }

        if (file.size > maxSize) {
            return 'Arquivo muito grande. Tamanho máximo: 5MB.';
        }

        return null;
    }

    function createImagePreview(file, index = null) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative group';
                previewDiv.dataset.index = index;

                previewDiv.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index !== null ? index + 1 : ''}"
                         class="w-full h-24 object-cover rounded-lg border-2 border-gray-200 hover:border-blue-300 transition-all duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">${index !== null ? `Foto ${index + 1}` : 'Principal'}</span>
                    </div>
                    ${index !== null ? `
                    <button type="button" onclick="removeGalleryImage(${index})"
                            class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-75 hover:bg-red-600 hover:scale-100">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                    ` : ''}
                `;

                resolve(previewDiv);
            };
            reader.readAsDataURL(file);
        });
    }

    // Main image preview
    if (imageInput) {
        imageInput.addEventListener('change', async function(e) {
            const file = e.target.files[0];
            if (file) {
                const error = validateFile(file);
                if (error) {
                    showNotification(error, 'error');
                    this.value = '';
                    mainPreview.classList.add('hidden');
                } else {
                    const previewDiv = await createImagePreview(file);
                    mainPreviewImg.src = previewDiv.querySelector('img').src;
                    mainPreview.classList.remove('hidden');
                    mainPreview.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    showNotification('Imagem principal selecionada com sucesso!', 'success');
                }
            }
        });
    }

    // Gallery images preview
    if (galleryInput) {
        galleryInput.addEventListener('change', async function(e) {
            const files = Array.from(e.target.files);
            let hasError = false;
            let validFiles = 0;
            const validFilesArray = [];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const error = validateFile(file);
                if (error) {
                    showNotification(`Erro no arquivo "${file.name}": ${error}`, 'error');
                    hasError = true;
                } else {
                    validFiles++;
                    validFilesArray.push({ file, index: i });
                }
            }

            if (hasError) {
                this.value = '';
                galleryPreview.classList.add('hidden');
            } else if (validFiles > 0) {
                // Clear existing previews
                galleryPreviewGrid.innerHTML = '';

                // Create previews for all valid files
                for (const { file, index } of validFilesArray) {
                    const previewDiv = await createImagePreview(file, index);
                    galleryPreviewGrid.appendChild(previewDiv);
                }

                galleryCount.textContent = validFiles;
                galleryStatus.textContent = `${validFiles} imagem(ns) selecionada(s) com sucesso!`;
                galleryPreview.classList.remove('hidden');
                galleryPreview.scrollIntoView({ behavior: 'smooth', block: 'center' });
                showNotification(`${validFiles} imagem(ns) selecionada(s) com sucesso!`, 'success');
            }
        });
    }

    // Focus on first error field
    const errorField = document.querySelector('.border-red-500');
    if (errorField) {
        errorField.focus();
        errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Form submission with loading and validation
    const form = document.getElementById('photo-form');
    const submitBtn = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');
    const btnLoading = document.getElementById('btn-loading');

    if (form && submitBtn && btnText && btnLoading) {
        form.addEventListener('submit', function(e) {
            // Basic validation
            const categorySelect = document.getElementById('category_id');
            const eventNameInput = document.getElementById('event_name');
            const titleInput = document.getElementById('title');
            const imageInput = document.getElementById('main_image');

            let isValid = true;

            if (!categorySelect.value) {
                showFieldError(categorySelect, 'Por favor, selecione uma categoria.');
                isValid = false;
            }

            if (!eventNameInput.value.trim()) {
                showFieldError(eventNameInput, 'Por favor, insira o nome do evento.');
                isValid = false;
            } else if (eventNameInput.value.trim().length < 3) {
                showFieldError(eventNameInput, 'O nome do evento deve ter pelo menos 3 caracteres.');
                isValid = false;
            }

            if (!titleInput.value.trim()) {
                showFieldError(titleInput, 'Por favor, insira o título do evento.');
                isValid = false;
            } else if (titleInput.value.trim().length < 3) {
                showFieldError(titleInput, 'O título do evento deve ter pelo menos 3 caracteres.');
                isValid = false;
            }

            if (!imageInput.files || imageInput.files.length === 0) {
                showFieldError(imageInput, 'Por favor, selecione uma imagem principal.');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                return false;
            }

            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
        });
    }

    // Smooth animations
    const formSections = document.querySelectorAll('.bg-gradient-to-r');
    formSections.forEach((section, index) => {
        if (section) {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            setTimeout(() => {
                section.style.transition = 'all 0.6s ease';
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 200);
        }
    });
});

// Global functions for image management
function removeMainImage() {
    const imageInput = document.getElementById('main_image');
    const mainPreview = document.getElementById('main-image-preview');

    if (imageInput) {
        imageInput.value = '';
    }

    if (mainPreview) {
        mainPreview.classList.add('hidden');
    }

    showNotification('Imagem principal removida', 'info');
}

function removeGalleryImage(index) {
    const galleryInput = document.getElementById('images');
    const galleryPreviewGrid = document.getElementById('gallery-preview-grid');
    const galleryCount = document.getElementById('gallery-count');
    const galleryStatus = document.getElementById('gallery-status');

    // Remove the preview element
    const previewElement = galleryPreviewGrid.querySelector(`[data-index="${index}"]`);
    if (previewElement) {
        previewElement.remove();
    }

    // Update file input (this is complex with multiple files, so we'll just clear and ask user to reselect)
    if (galleryInput) {
        galleryInput.value = '';
    }

    // Update counters
    const remainingImages = galleryPreviewGrid.children.length;
    if (remainingImages === 0) {
        document.getElementById('gallery-preview').classList.add('hidden');
        showNotification('Galeria limpa', 'info');
    } else {
        galleryCount.textContent = remainingImages;
        galleryStatus.textContent = `${remainingImages} imagem(ns) restante(s)`;
        showNotification('Imagem removida da galeria. Selecione novamente as imagens desejadas.', 'info');
    }
}

function clearGallery() {
    const galleryInput = document.getElementById('images');
    const galleryPreview = document.getElementById('gallery-preview');

    if (galleryInput) {
        galleryInput.value = '';
    }

    if (galleryPreview) {
        galleryPreview.classList.add('hidden');
    }

    showNotification('Galeria limpa', 'info');
}

function showFieldError(field, message) {
    // Remove existing error
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }

    // Add error styling
    field.classList.remove('border-gray-300');
    field.classList.add('border-red-500');

    // Create error message
    const errorDiv = document.createElement('p');
    errorDiv.className = 'mt-3 text-sm text-red-600 flex items-center field-error';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i>${message}`;
    errorDiv.setAttribute('role', 'alert');

    field.parentNode.appendChild(errorDiv);

    // Focus on field
    field.focus();
    field.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;

    const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle';

    notification.innerHTML = `
        <div class="flex items-center ${bgColor} text-white p-4 rounded-lg">
            <i class="fas ${icon} mr-3"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
}
</script>
@endsection
