@extends('layouts.backoffice')

@section('title', 'Notícias')

@section('content')
<div class="w-full space-y-8">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-newspaper mr-3 text-purple-500"></i>
                    Notícias
                </h2>
                <p class="text-lg text-gray-600">Gerencie as notícias do site de forma fácil e rápida</p>
            </div>
            <div class="mt-6 lg:mt-0 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('backoffice.admin.news.create') }}"
                    class="btn-primary inline-flex items-center justify-center px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-plus mr-3 text-lg"></i>
                    <span class="text-lg font-semibold">Nova Notícia</span>
                </a>
                <a href="{{ route('backoffice.admin.news.index') }}"
                    class="inline-flex items-center justify-center px-6 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Atualizar
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 card-hover">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mr-6">
                    <i class="fas fa-newspaper text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total de Notícias</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $news->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 card-hover">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mr-6">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Última Publicação</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ optional($news->first())->date ? \Carbon\Carbon::parse($news->first()->date)->format('d/m/Y') : '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- News Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-list mr-3 text-purple-500"></i>
                Lista de Notícias
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-heading mr-3 text-purple-500"></i>
                                Título
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-calendar mr-3 text-blue-500"></i>
                                Data
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-image mr-3 text-green-500"></i>
                                Imagem
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
                    @forelse ($news as $item)
                        <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-blue-50 transition-all duration-300">
                            <td class="px-8 py-6">
                                <div class="text-lg font-semibold text-gray-900 mb-1">{{ $item->title }}</div>
                                @if($item->excerpt)
                                    <div class="text-sm text-gray-600">{{ Str::limit($item->excerpt, 60) }}</div>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-lg font-medium text-gray-900">
                                    @if($item->start_date && $item->end_date && $item->start_date != $item->end_date)
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
                                    @elseif($item->start_date)
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                @if($item->image)
                                    <div class="w-20 h-20 rounded-xl overflow-hidden border-2 border-gray-200 shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="imagem" class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('backoffice.admin.news.edit', $item) }}"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-md">
                                        <i class="fas fa-edit mr-2"></i>
                                        Editar
                                    </a>
                                    <form action="{{ route('backoffice.admin.news.destroy', $item) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 shadow-md"
                                            onclick="return confirm('Tem certeza que deseja excluir esta notícia? Esta ação não pode ser desfeita.')">
                                            <i class="fas fa-trash mr-2"></i>
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-newspaper text-gray-400 text-4xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhuma notícia encontrada</h3>
                                    <p class="text-gray-600 mb-6 text-lg">Comece criando sua primeira notícia para informar os visitantes do site</p>
                                    <a href="{{ route('backoffice.admin.news.create') }}"
                                        class="btn-primary inline-flex items-center px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-plus mr-3 text-lg"></i>
                                        <span class="text-lg font-semibold">Criar Primeira Notícia</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-4">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
