@extends('layouts.backoffice')
@section('title', 'Editar Slide do Carrossel')
@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center">
            <a href="{{ route('backoffice.admin.carousel-slides.index') }}"
               class="mr-6 p-3 text-gray-400 hover:text-gray-600 transition-all duration-300 hover:bg-gray-100 rounded-xl"
               aria-label="Voltar para lista de slides">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-edit mr-3 text-blue-500"></i>
                    Editar Slide do Carrossel
                </h2>
                <p class="text-lg text-gray-600">Altere as informações do slide do carrossel</p>
            </div>
        </div>
    </div>
    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-images mr-3 text-blue-500"></i>
                Informações do Slide
            </h3>
        </div>
        <form action="{{ route('backoffice.admin.carousel-slides.update', $carouselSlide) }}" method="POST" enctype="multipart/form-data" class="p-8" novalidate>
            @csrf
            @method('PUT')
            <div class="space-y-8">
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                    <label for="title" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-heading mr-3 text-blue-500"></i>
                        Título <span class="text-red-500" aria-label="Campo obrigatório">*</span>
                    </label>
                    <input type="text" name="title" id="title" class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm" value="{{ old('title', $carouselSlide->title) }}" required maxlength="255">
                </div>
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                    <label for="link" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-link mr-3 text-green-500"></i>
                        Link <span class="text-red-500" aria-label="Campo obrigatório">*</span>
                    </label>
                    <input type="text" name="link" id="link" class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm" value="{{ old('link', $carouselSlide->link) }}" required maxlength="255">
                </div>
                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-2xl p-6 border border-orange-100">
                    <label for="order" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-sort-numeric-up mr-3 text-orange-500"></i>
                        Ordem
                    </label>
                    <input type="number" name="order" id="order" class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300 shadow-sm" value="{{ old('order', $carouselSlide->order) }}">
                </div>
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100 flex items-center">
                    <input type="checkbox" name="active" id="active" class="form-check-input mr-3" value="1" {{ $carouselSlide->active ? 'checked' : '' }}>
                    <label for="active" class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-check-circle mr-2 text-indigo-500"></i>
                        Ativo
                    </label>
                </div>
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100">
                    <label for="image" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-image mr-3 text-purple-500"></i>
                        Imagem
                    </label>
                    <input type="file" name="image" id="image" class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 shadow-sm">
                    @if($carouselSlide->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $carouselSlide->image) }}" alt="Imagem atual" class="w-40 h-40 object-cover rounded-xl border-2 border-purple-200 shadow-lg">
                            <p class="text-sm text-gray-600 mt-2">Imagem atual do slide</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-gray-200 mt-8">
                <a href="{{ route('backoffice.admin.carousel-slides.index') }}"
                   class="w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200 text-center font-semibold">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </a>
                <button type="submit"
                        class="w-full sm:w-auto btn-primary px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
                    <i class="fas fa-save mr-3 text-lg"></i>
                    Atualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
