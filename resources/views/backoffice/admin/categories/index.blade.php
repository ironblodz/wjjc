@extends('layouts.backoffice')

@section('title', 'Categorias')

@section('content')
<div class="w-full space-y-8">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-tags mr-3 text-purple-500"></i>
                    Categorias
                </h2>
                <p class="text-lg text-gray-600">Organize seus eventos por categorias de forma eficiente</p>
            </div>
            <div class="mt-6 lg:mt-0 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('backoffice.admin.categories.create') }}"
                    class="btn-primary inline-flex items-center justify-center px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-plus mr-3 text-lg"></i>
                    <span class="text-lg font-semibold">Nova Categoria</span>
                </a>
                <a href="{{ route('backoffice.admin.categories.index') }}"
                    class="inline-flex items-center justify-center px-6 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Atualizar
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 card-hover">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mr-6">
                    <i class="fas fa-tags text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total de Categorias</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $categories->count() }}</p>
                    <p class="text-xs text-blue-600 mt-2">
                        <i class="fas fa-chart-line mr-1"></i>
                        Organizadas
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 card-hover">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mr-6">
                    <i class="fas fa-images text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total de Eventos</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $categories->sum(function($cat) { return $cat->photos->count(); }) }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-calendar mr-1"></i>
                        Ativos
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 card-hover">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mr-6">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Categoria Mais Ativa</p>
                    <p class="text-2xl font-bold text-gray-900">
                        @php
                            $mostActive = $categories->sortByDesc(function($cat) { return $cat->photos->count(); })->first();
                        @endphp
                        {{ $mostActive ? $mostActive->name : 'N/A' }}
                    </p>
                    <p class="text-xs text-purple-600 mt-2">
                        <i class="fas fa-star mr-1"></i>
                        Popular
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-list mr-3 text-blue-500"></i>
                Lista de Categorias
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-hashtag mr-3 text-blue-500"></i>
                                ID
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-tag mr-3 text-purple-500"></i>
                                Nome
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-link mr-3 text-green-500"></i>
                                Slug
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-images mr-3 text-orange-500"></i>
                                Eventos
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-cogs mr-3 text-gray-500"></i>
                                Ações
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300">
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800">
                                    <i class="fas fa-hashtag mr-2 text-blue-500"></i>
                                    #{{ $category->id }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-tag text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <div class="text-lg font-semibold text-gray-900">{{ $category->name }}</div>
                                        @if($category->description)
                                            <div class="text-sm text-gray-600">{{ Str::limit($category->description, 50) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <code class="text-sm bg-gray-100 text-gray-800 px-3 py-2 rounded-lg font-mono border border-gray-200">
                                    {{ $category->slug }}
                                </code>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800">
                                        <i class="fas fa-images mr-2"></i>
                                        {{ $category->photos->count() }} eventos
                                    </span>
                                    @if($category->photos->count() > 0)
                                        <div class="ml-3 text-xs text-gray-500">
                                            {{ $category->photos->sum(function($photo) { return $photo->images->count(); }) }} fotos
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('backoffice.admin.categories.edit', $category) }}"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-md">
                                        <i class="fas fa-edit mr-2"></i>
                                        Editar
                                    </a>
                                    <form action="{{ route('backoffice.admin.categories.destroy', $category) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 shadow-md"
                                            onclick="return confirm('Tem certeza que deseja excluir esta categoria? Esta ação não pode ser desfeita.')">
                                            <i class="fas fa-trash mr-2"></i>
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-tags text-gray-400 text-4xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhuma categoria encontrada</h3>
                                    <p class="text-gray-600 mb-6 text-lg">Comece criando sua primeira categoria para organizar seus eventos</p>
                                    <a href="{{ route('backoffice.admin.categories.create') }}"
                                        class="btn-primary inline-flex items-center px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-plus mr-3 text-lg"></i>
                                        <span class="text-lg font-semibold">Criar Primeira Categoria</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Adicionar animações suaves
    document.addEventListener('DOMContentLoaded', function() {
        // Animar cards ao carregar
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });

        // Animar linhas da tabela
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                row.style.transition = 'all 0.5s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 100 + 300);
        });
    });
</script>
@endpush
@endsection
