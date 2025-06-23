@extends('layouts.backoffice')

@section('title', 'Dashboard')

@section('content')
<div class="w-full space-y-8">
    <!-- Welcome Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl p-8 text-white shadow-2xl">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="flex-1">
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    Bem-vindo, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-xl text-indigo-100 mb-6">
                    Gerencie seus eventos e categorias com facilidade e estilo
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('backoffice.admin.photos.create') }}"
                       class="inline-flex items-center px-6 py-3 bg-white bg-opacity-20 backdrop-blur-sm rounded-xl hover:bg-opacity-30 transition-all duration-300 border border-white border-opacity-30">
                        <i class="fas fa-plus mr-2"></i>
                        Novo Evento
                    </a>
                    <a href="{{ route('backoffice.admin.categories.create') }}"
                       class="inline-flex items-center px-6 py-3 bg-white bg-opacity-20 backdrop-blur-sm rounded-xl hover:bg-opacity-30 transition-all duration-300 border border-white border-opacity-30">
                        <i class="fas fa-tag mr-2"></i>
                        Nova Categoria
                    </a>
                </div>
            </div>
            <div class="hidden lg:block mt-8 lg:mt-0">
                <div class="relative">
                    <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-camera text-6xl text-white"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-yellow-800 text-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Events -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total de Eventos</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_photos'] ?? 0 }}</p>
                    <p class="text-xs text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +12% este mês
                    </p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total de Categorias</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_categories'] ?? 0 }}</p>
                    <p class="text-xs text-blue-600 mt-1">
                        <i class="fas fa-chart-line mr-1"></i>
                        Organizadas
                    </p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-tags text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total de Usuários</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] ?? 0 }}</p>
                    <p class="text-xs text-indigo-600 mt-1">
                        <i class="fas fa-users mr-1"></i>
                        Ativos
                    </p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Images -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total de Imagens</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_images'] ?? 0 }}</p>
                    <p class="text-xs text-orange-600 mt-1">
                        <i class="fas fa-image mr-1"></i>
                        Armazenadas
                    </p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-images text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-chart-line mr-2 text-blue-500"></i>
                    Atividade Recente
                </h3>
                <span class="text-sm text-gray-500">Últimos 7 dias</span>
            </div>
            <div class="space-y-4">
                <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-plus text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Novo evento criado</p>
                        <p class="text-sm text-gray-600">Casamento João e Maria</p>
                    </div>
                    <span class="text-xs text-gray-500">2h atrás</span>
                </div>
                <div class="flex items-center p-4 bg-green-50 rounded-xl">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-upload text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Fotos enviadas</p>
                        <p class="text-sm text-gray-600">15 imagens para Aniversário</p>
                    </div>
                    <span class="text-xs text-gray-500">4h atrás</span>
                </div>
                <div class="flex items-center p-4 bg-purple-50 rounded-xl">
                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-tag text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Categoria criada</p>
                        <p class="text-sm text-gray-600">Eventos Corporativos</p>
                    </div>
                    <span class="text-xs text-gray-500">1 dia atrás</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-bolt mr-2 text-yellow-500"></i>
                Ações Rápidas
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('backoffice.admin.photos.create') }}"
                   class="group p-4 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl text-white hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-plus text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold">Novo Evento</p>
                            <p class="text-sm text-blue-100">Criar galeria</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('backoffice.admin.categories.create') }}"
                   class="group p-4 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl text-white hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-tag text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold">Nova Categoria</p>
                            <p class="text-sm text-purple-100">Organizar eventos</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('backoffice.admin.photos.index') }}"
                   class="group p-4 bg-gradient-to-r from-green-500 to-green-600 rounded-xl text-white hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-images text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold">Gerenciar Eventos</p>
                            <p class="text-sm text-green-100">Ver todos</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('backoffice.admin.categories.index') }}"
                   class="group p-4 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl text-white hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-cogs text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold">Gerenciar Categorias</p>
                            <p class="text-sm text-orange-100">Organizar</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- System Status -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-6">
            <i class="fas fa-server mr-2 text-gray-500"></i>
            Status do Sistema
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center p-4 bg-green-50 rounded-xl">
                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                <div>
                    <p class="font-medium text-gray-900">Sistema Online</p>
                    <p class="text-sm text-gray-600">Tudo funcionando</p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                <div>
                    <p class="font-medium text-gray-900">Armazenamento</p>
                    <p class="text-sm text-gray-600">75% utilizado</p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-yellow-50 rounded-xl">
                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                <div>
                    <p class="font-medium text-gray-900">Backup</p>
                    <p class="text-sm text-gray-600">Último: 2h atrás</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Adicionar animações suaves
    document.addEventListener('DOMContentLoaded', function() {
        // Animar cards ao carregar
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush
@endsection