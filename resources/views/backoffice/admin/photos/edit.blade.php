@extends('layouts.backoffice')

@section('title', 'Editar Evento')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center">
            <a href="{{ route('backoffice.admin.photos.index') }}"
               class="mr-6 p-3 text-gray-400 hover:text-gray-600 transition-all duration-300 hover:bg-gray-100 rounded-xl">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-edit mr-3 text-purple-500"></i>
                    Editar Evento
                </h2>
                <p class="text-lg text-gray-600">Atualize as informações do evento "{{ $photo->event_name }}"</p>
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

        <form action="{{ route('backoffice.admin.photos.update', $photo) }}" method="POST" enctype="multipart/form-data" class="p-8" id="photo-form">
            @csrf
            @method('PUT')

            <div class="space-y-8">
                <!-- Category Field -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                    <label for="category_id" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-tag mr-3 text-blue-500"></i>
                        Categoria
                    </label>
                    <select name="category_id" id="category_id"
                            class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('category_id') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm"
                            required aria-invalid="{{ $errors->has('category_id') ? 'true' : 'false' }}" aria-describedby="category-error">
                        <option value="">Selecione uma categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $photo->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="category-error">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>

                <!-- Event Name Field -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                    <label for="event_name" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-calendar mr-3 text-green-500"></i>
                        Nome do Evento
                    </label>
                    <input type="text"
                           name="event_name"
                           id="event_name"
                           value="{{ old('event_name', $photo->event_name) }}"
                           class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('event_name') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm"
                           placeholder="Ex: Casamento João e Maria, Aniversário 50 anos..."
                           required aria-invalid="{{ $errors->has('event_name') ? 'true' : 'false' }}" aria-describedby="event-name-error"
                           autofocus>
                    @if($errors->has('event_name'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="event-name-error">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('event_name') }}
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
                              placeholder="Descreva o evento..." aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}" aria-describedby="description-error">{{ old('description', $photo->description) }}</textarea>
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                        Uma descrição detalhada ajuda a contextualizar melhor o evento.
                    </p>
                    @if($errors->has('description'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="description-error">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>

                <!-- Current Main Image -->
                @if($photo->main_image)
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-200">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-image mr-3 text-blue-500"></i>
                        Imagem Principal Atual
                    </label>
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('storage/' . $photo->main_image) }}"
                             alt="Imagem principal atual"
                             class="w-24 h-24 object-cover rounded-xl border-2 border-gray-200">
                        <div>
                            <p class="text-sm text-gray-600">Imagem atual do evento</p>
                            <p class="text-xs text-gray-500">Faça upload de uma nova imagem para substituir</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Main Image Upload -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-image mr-3 text-purple-500"></i>
                        Nova Imagem Principal (Opcional)
                    </label>
                    <div class="border-2 border-dashed {{ $errors->has('image') ? 'border-red-500' : 'border-gray-300' }} rounded-xl p-8 text-center hover:border-gray-400 transition-all duration-300 bg-white">
                        <input type="file" name="image" id="image" accept="image/*" class="hidden">
                        <label for="image" class="cursor-pointer">
                            <div class="space-y-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto">
                                    <i class="fas fa-cloud-upload-alt text-white text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900">Clique para selecionar uma nova imagem</p>
                                    <p class="text-sm text-gray-600 mt-1">PNG, JPG, JPEG até 5MB</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Deixe em branco para manter a imagem atual.
                    </p>
                    @if($errors->has('image'))
                        <p class="mt-3 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                </div>

                <!-- Current Gallery -->
                @if($photo->images->count() > 0)
                <div class="bg-gradient-to-r from-gray-50 to-green-50 rounded-2xl p-6 border border-gray-200">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-images mr-3 text-green-500"></i>
                        Galeria Atual ({{ $photo->images->count() }} fotos)
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach($photo->images as $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                 alt="Foto da galeria"
                                 class="w-full h-24 object-cover rounded-lg border-2 border-gray-200">
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-semibold">Foto {{ $loop->iteration }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Gallery Images Upload -->
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-images mr-3 text-indigo-500"></i>
                        Adicionar Fotos à Galeria (Opcional)
                    </label>
                    <div class="border-2 border-dashed {{ $errors->has('gallery_images.*') ? 'border-red-500' : 'border-gray-300' }} rounded-xl p-8 text-center hover:border-gray-400 transition-all duration-300 bg-white">
                        <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" class="hidden" multiple>
                        <label for="gallery_images" class="cursor-pointer">
                            <div class="space-y-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-full flex items-center justify-center mx-auto">
                                    <i class="fas fa-images text-white text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900">Clique para adicionar mais fotos</p>
                                    <p class="text-sm text-gray-600 mt-1">PNG, JPG, JPEG até 5MB cada</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                        As novas fotos serão adicionadas à galeria existente.
                    </p>
                    @if($errors->has('gallery_images.*'))
                        <p class="mt-3 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('gallery_images.*') }}
                        </p>
                    @endif
                </div>

                <!-- Event Stats -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-8 border border-gray-200">
                    <h4 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-chart-bar mr-3 text-blue-500"></i>
                        Estatísticas do Evento
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-calendar text-white text-xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-2">{{ $photo->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-600">Data de Criação</div>
                        </div>
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-images text-white text-xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-2">{{ $photo->images->count() }}</div>
                            <div class="text-sm text-gray-600">Fotos na Galeria</div>
                        </div>
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-tag text-white text-xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-2">{{ $photo->category->name }}</div>
                            <div class="text-sm text-gray-600">Categoria</div>
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
                            Atualizar Evento
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
    // Focus on first error field
    const errorField = document.querySelector('.border-red-500');
    if (errorField) {
        errorField.focus();
        errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Form submission with loading
    const form = document.getElementById('photo-form');
    const submitBtn = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');
    const btnLoading = document.getElementById('btn-loading');

    if (form && submitBtn && btnText && btnLoading) {
        form.addEventListener('submit', function(e) {
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
</script>
@endsection
