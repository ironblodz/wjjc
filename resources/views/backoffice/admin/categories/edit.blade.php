@extends('layouts.backoffice')

@section('title', 'Editar Categoria')

@section('content')
<div class="w-full max-w-4xl mx-auto space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center">
            <a href="{{ route('backoffice.admin.categories.index') }}"
               class="mr-6 p-3 text-gray-400 hover:text-gray-600 transition-all duration-300 hover:bg-gray-100 rounded-xl">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-edit mr-3 text-purple-500"></i>
                    Editar Categoria
                </h2>
                <p class="text-lg text-gray-600">Atualize as informações da categoria "{{ $category->name }}"</p>
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

        <form action="{{ route('backoffice.admin.categories.update', $category) }}" method="POST" class="p-8" id="category-form">
            @csrf
            @method('PUT')

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
                           value="{{ old('name', $category->name) }}"
                           class="w-full px-6 py-4 text-lg border-2 @error('name') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm"
                           placeholder="Ex: Casamentos, Aniversários, Corporativo..."
                           required aria-invalid="@error('name')true@enderror" aria-describedby="name-error"
                           autofocus>
                    @error('name')
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="name-error">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
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
                           value="{{ old('slug', $category->slug) }}"
                           class="w-full px-6 py-4 text-lg border-2 @error('slug') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm"
                           placeholder="Ex: casamentos, aniversarios, corporativo..."
                           required aria-invalid="@error('slug')true@enderror" aria-describedby="slug-error">
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        O slug será usado na URL. Use apenas letras minúsculas, números e hífens.
                    </p>
                    @error('slug')
                        <p class="mt-3 text-sm text-red-600 flex items-center" id="slug-error">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
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
                              placeholder="Descreva brevemente esta categoria...">{{ old('description', $category->description) }}</textarea>
                    <p class="mt-3 text-sm text-gray-600 flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                        Uma descrição ajuda a identificar melhor o propósito da categoria.
                    </p>
                </div>

                <!-- Category Stats -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-8 border border-gray-200">
                    <h4 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fas fa-chart-bar mr-3 text-blue-500"></i>
                        Estatísticas da Categoria
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-calendar text-white text-xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-2">{{ $category->photos->count() }}</div>
                            <div class="text-sm text-gray-600">Eventos</div>
                        </div>
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-images text-white text-xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-2">
                                {{ $category->photos->sum(function($photo) { return $photo->images->count(); }) }}
                            </div>
                            <div class="text-sm text-gray-600">Fotos</div>
                        </div>
                        <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-star text-white text-xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-2">
                                {{ $category->photos->count() > 0 ? round($category->photos->sum(function($photo) { return $photo->images->count(); }) / $category->photos->count(), 1) : 0 }}
                            </div>
                            <div class="text-sm text-gray-600">Média/Evento</div>
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
                            Atualizar Categoria
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

@push('scripts')
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
            .trim('-'); // Remove leading/trailing hyphens
        document.getElementById('slug').value = slug;
    });

    // Foco automático no primeiro erro
    window.addEventListener('DOMContentLoaded', function() {
        const errorField = document.querySelector('.border-red-500');
        if (errorField) {
            errorField.focus();
            errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    // Botão com loading ao enviar
    document.getElementById('category-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        document.getElementById('btn-text').classList.add('hidden');
        document.getElementById('btn-loading').classList.remove('hidden');
    });

    // Animações suaves
    document.addEventListener('DOMContentLoaded', function() {
        const formSections = document.querySelectorAll('.bg-gradient-to-r');
        formSections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            setTimeout(() => {
                section.style.transition = 'all 0.6s ease';
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 200);
        });
    });
</script>
@endpush
@endsection
