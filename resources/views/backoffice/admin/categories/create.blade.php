@extends('layouts.backoffice')

@section('title', 'Nova Categoria')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center">
            <a href="{{ route('backoffice.admin.categories.index') }}"
               class="mr-6 p-3 text-gray-400 hover:text-gray-600 transition-all duration-300 hover:bg-gray-100 rounded-xl">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-plus mr-3 text-green-500"></i>
                    Nova Categoria
                </h2>
                <p class="text-lg text-gray-600">Crie uma nova categoria para organizar seus eventos de forma eficiente</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-cog mr-3 text-blue-500"></i>
                Informações da Categoria
            </h3>
        </div>

        <form action="{{ route('backoffice.admin.categories.store') }}" method="POST" class="p-8" id="category-form">
            @csrf

            <div class="space-y-8">
                <!-- Name Field -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                    <label for="name" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-tag mr-3 text-blue-500"></i>
                        Nome da Categoria
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm"
                           placeholder="Ex: Casamentos, Aniversários, Corporativo..."
                           required aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" aria-describedby="name-error"
                           autofocus>
                    @if($errors->has('name'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="name-error">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                <!-- Slug Field -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                    <label for="slug" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-link mr-3 text-green-500"></i>
                        Slug (URL)
                    </label>
                    <input type="text"
                           name="slug"
                           id="slug"
                           value="{{ old('slug') }}"
                           class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('slug') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm"
                           placeholder="Ex: casamentos, aniversarios, corporativo..."
                           required aria-invalid="{{ $errors->has('slug') ? 'true' : 'false' }}" aria-describedby="slug-error">
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        O slug será usado na URL. Use apenas letras minúsculas, números e hífens.
                    </p>
                    @if($errors->has('slug'))
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="slug-error">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>

                <!-- Description Field -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100">
                    <label for="description" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-align-left mr-3 text-purple-500"></i>
                        Descrição (Opcional)
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 shadow-sm resize-none"
                              placeholder="Descreva brevemente esta categoria...">{{ old('description') }}</textarea>
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                        Uma descrição ajuda a identificar melhor o propósito da categoria.
                    </p>
                </div>

                <!-- Tips Section -->
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-8 border border-yellow-200">
                    <h4 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-lightbulb mr-3 text-yellow-500"></i>
                        Dicas para uma Boa Categoria
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900 mb-1">Nome Descritivo</h5>
                                <p class="text-sm text-gray-600">Use nomes claros que identifiquem facilmente o tipo de evento</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900 mb-1">Slug Simples</h5>
                                <p class="text-sm text-gray-600">Mantenha o slug curto e fácil de lembrar</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900 mb-1">Organização</h5>
                                <p class="text-sm text-gray-600">Crie categorias que facilitem a busca e organização</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900 mb-1">Flexibilidade</h5>
                                <p class="text-sm text-gray-600">Pense em categorias que possam acomodar diferentes tipos de eventos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-gray-200">
                    <a href="{{ route('backoffice.admin.categories.index') }}"
                       class="w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200 text-center font-semibold">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" id="submit-btn"
                            class="w-full sm:w-auto btn-primary px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
                        <span id="btn-text">
                            <i class="fas fa-save mr-3 text-lg"></i>
                            Criar Categoria
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
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function() {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        });
    }

    // Focus on first error field
    const errorField = document.querySelector('.border-red-500');
    if (errorField) {
        errorField.focus();
        errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Form submission with loading
    const form = document.getElementById('category-form');
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
