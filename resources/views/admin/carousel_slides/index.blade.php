@extends('layouts.backoffice')
@section('title', 'Carrossel')
@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-images mr-3 text-blue-500"></i>
                    Carrossel
                </h2>
                <p class="text-lg text-gray-600">Gerencie os slides do carrossel principal do site</p>
            </div>
            <div class="mt-6 lg:mt-0 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('backoffice.admin.carousel-slides.create') }}"
                   class="btn-primary inline-flex items-center justify-center px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-plus mr-3 text-lg"></i>
                    <span class="text-lg font-semibold">Novo Slide</span>
                </a>
                <a href="{{ route('backoffice.admin.carousel-slides.index') }}"
                   class="inline-flex items-center justify-center px-6 py-4 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Atualizar
                </a>
            </div>
        </div>
    </div>

    <!-- Slides Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-list mr-3 text-blue-500"></i>
                Lista de Slides
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-image mr-3 text-blue-500"></i>
                                Imagem
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-heading mr-3 text-purple-500"></i>
                                Título
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-link mr-3 text-green-500"></i>
                                Link
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-sort-numeric-up mr-3 text-orange-500"></i>
                                Ordem
                            </div>
                        </th>
                        <th class="px-8 py-6 text-left">
                            <div class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-check-circle mr-3 text-indigo-500"></i>
                                Ativo
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
                    @forelse($slides as $slide)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300">
                            <td class="px-8 py-6">
                                <div class="w-20 h-20 rounded-xl overflow-hidden border-2 border-gray-200 shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                    <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-lg font-semibold text-gray-900 mb-1">{{ $slide->title }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <a href="{{ url($slide->link) }}" target="_blank" class="text-blue-600 hover:underline">{{ $slide->link }}</a>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800">
                                    <i class="fas fa-sort-numeric-up mr-2"></i>
                                    {{ $slide->order }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $slide->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i class="fas {{ $slide->active ? 'fa-check-circle' : 'fa-times-circle' }} mr-2"></i>
                                    {{ $slide->active ? 'Sim' : 'Não' }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('backoffice.admin.carousel-slides.edit', $slide) }}"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-md">
                                        <i class="fas fa-edit mr-2"></i>
                                        Editar
                                    </a>
                                    <form action="{{ route('backoffice.admin.carousel-slides.destroy', $slide) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 shadow-md"
                                            onclick="return confirm('Tem certeza que deseja excluir este slide? Esta ação não pode ser desfeita.')">
                                            <i class="fas fa-trash mr-2"></i>
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-images text-gray-400 text-4xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhum slide encontrado</h3>
                                    <p class="text-gray-600 mb-6 text-lg">Comece criando seu primeiro slide para o carrossel</p>
                                    <a href="{{ route('backoffice.admin.carousel-slides.create') }}"
                                       class="btn-primary inline-flex items-center px-8 py-4 text-white rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-plus mr-3 text-lg"></i>
                                        <span class="text-lg font-semibold">Criar Primeiro Slide</span>
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
@endsection
