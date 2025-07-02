@extends('layouts.backoffice')

@section('title', 'Nova Notícia')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center">
            <a href="{{ route('backoffice.admin.news.index') }}"
               class="mr-6 p-3 text-gray-400 hover:text-gray-600 transition-all duration-300 hover:bg-gray-100 rounded-xl"
               aria-label="Voltar para lista de notícias">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-newspaper mr-3 text-purple-500"></i>
                    Nova Notícia
                </h2>
                <p class="text-lg text-gray-600">Adicione uma nova notícia para o site</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-info-circle mr-3 text-purple-500"></i>
                Informações da Notícia
            </h3>
        </div>
        <form action="{{ route('backoffice.admin.news.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8" novalidate>
            @csrf
            <!-- Título -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100">
                <label for="title" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-heading mr-3 text-purple-500"></i>
                    Título <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 shadow-sm"
                       required minlength="3" maxlength="255" autofocus>
                @error('title')<p class="mt-3 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>@enderror
            </div>
            <!-- Resumo -->
            <div class="bg-gradient-to-r from-pink-50 to-yellow-50 rounded-2xl p-6 border border-pink-100">
                <label for="excerpt" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-align-left mr-3 text-pink-500"></i>
                    Resumo
                </label>
                <input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt') }}"
                       class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('excerpt') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 shadow-sm"
                       maxlength="255">
                @error('excerpt')<p class="mt-3 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>@enderror
            </div>
            <!-- Conteúdo -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-100">
                <label for="body" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-align-left mr-3 text-yellow-500"></i>
                    Conteúdo <span class="text-red-500">*</span>
                </label>
                <textarea name="body" id="body" rows="6"
                          class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('body') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300 shadow-sm resize-none"
                          required>{{ old('body') }}</textarea>
                @error('body')<p class="mt-3 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>@enderror
            </div>
            <!-- Data -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                    <label for="start_date" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-calendar mr-3 text-blue-500"></i>
                        Data de Início
                    </label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                           class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('start_date') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm">
                    @error('start_date')<p class="mt-3 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>@enderror
                </div>
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                    <label for="end_date" class="block text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-calendar mr-3 text-blue-500"></i>
                        Data de Fim
                    </label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                           class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('end_date') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm">
                    @error('end_date')<p class="mt-3 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>@enderror
                </div>
            </div>
            <!-- Imagem -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                <label for="image" class="block text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-image mr-3 text-green-500"></i>
                    Imagem
                </label>
                <input type="file" name="image" id="image"
                       class="w-full px-6 py-4 text-lg border-2 {{ $errors->has('image') ? 'border-red-500' : 'border-gray-300' }} rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 transition-all duration-300 shadow-sm">
                @error('image')<p class="mt-3 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</p>@enderror
            </div>
            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-gray-200">
                <a href="{{ route('backoffice.admin.news.index') }}"
                   class="w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200 text-center font-semibold">
                    <i class="fas fa-times mr-2"></i>
                    Cancelar
                </a>
                <button type="submit"
                        class="w-full sm:w-auto btn-primary px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center font-semibold">
                    <i class="fas fa-save mr-3 text-lg"></i>
                    Criar Notícia
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
