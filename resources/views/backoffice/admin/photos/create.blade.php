@extends('layouts.backoffice')

@section('title', 'Novo Evento')

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

        <form action="{{ route('backoffice.admin.photos.store') }}" method="POST" enctype="multipart/form-data" class="p-8" id="photo-form">
            @csrf

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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                           value="{{ old('event_name') }}"
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
                              placeholder="Descreva o evento..." aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}" aria-describedby="description-error">{{ old('description') }}</textarea>
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

                <!-- Main Image Upload -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-image mr-3 text-purple-500"></i>
                        Imagem Principal
                    </label>
                    <div class="border-2 border-dashed {{ $errors->has('image') ? 'border-red-500' : 'border-gray-300' }} rounded-xl p-8 text-center hover:border-gray-400 transition-all duration-300 bg-white">
                        <input type="file" name="image" id="image" accept="image/*" class="hidden" required>
                        <label for="image" class="cursor-pointer">
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
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Esta será a imagem principal do evento, exibida em destaque.
                    </p>
                    @if($errors->has('image'))
                        <p class="mt-3 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                </div>

                <!-- Gallery Images Upload -->
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100">
                    <label class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-images mr-3 text-indigo-500"></i>
                        Galeria de Fotos (Opcional)
                    </label>
                    <div class="border-2 border-dashed {{ $errors->has('images.*') ? 'border-red-500' : 'border-gray-300' }} rounded-xl p-8 text-center hover:border-gray-400 transition-all duration-300 bg-white">
                        <input type="file" name="images[]" id="images" accept="image/*" class="hidden" multiple>
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
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                        Você pode selecionar várias imagens para criar uma galeria completa do evento.
                    </p>
                    @if($errors->has('images.*'))
                        <p class="mt-3 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('images.*') }}
                        </p>
                    @endif
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
