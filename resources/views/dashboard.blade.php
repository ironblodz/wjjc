@extends('layouts.backoffice')

@section('title', 'Dashboard')

@php
    $totalEvents = $totalEvents ?? 0;
    $totalPhotos = $totalPhotos ?? 0;
    $totalCategories = $totalCategories ?? 0;
@endphp

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Bem-vindo, {{ Auth::user()->name }}!</h1>
                <p class="mt-1 text-blue-100">Gerencie seus eventos e categorias de forma simples e eficiente</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-camera text-6xl text-blue-200"></i>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Eventos</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalEvents }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="fas fa-images text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Fotos</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPhotos }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <i class="fas fa-tags text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Categorias</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
            <div class="flex items-center">
                <div class="p-3 bg-orange-100 rounded-lg">
                    <i class="fas fa-star text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Média por Evento</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $totalEvents > 0 ? round($totalPhotos / $totalEvents, 1) : 0 }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Backoffice Administration -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-cogs mr-2 text-blue-500"></i>
                    Administração
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <a href="{{ route('backoffice.admin.photos.index') }}"
                        class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200 group">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-images text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">Gerenciar Eventos</h4>
                            <p class="text-sm text-gray-600">Crie e edite eventos com suas galerias</p>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                    </a>

                    <a href="{{ route('backoffice.admin.categories.index') }}"
                        class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors duration-200 group">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-tags text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">Gerenciar Categorias</h4>
                            <p class="text-sm text-gray-600">Organize seus eventos por categorias</p>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-purple-500 transition-colors duration-200"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-clock mr-2 text-green-500"></i>
                    Atividade Recente
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-1">
                            <i class="fas fa-plus text-green-600 text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Novo evento criado</p>
                            <p class="text-xs text-gray-500">Há 2 horas</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3 mt-1">
                            <i class="fas fa-edit text-blue-600 text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Categoria atualizada</p>
                            <p class="text-xs text-gray-500">Há 1 dia</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3 mt-1">
                            <i class="fas fa-upload text-purple-600 text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Fotos enviadas</p>
                            <p class="text-xs text-gray-500">Há 2 dias</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips Section -->
    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-6 border border-yellow-200">
        <div class="flex items-start">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                <i class="fas fa-lightbulb text-yellow-600"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Dicas para um Backoffice Eficiente</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div class="flex items-start">
                        <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                        <span>Mantenha suas categorias bem organizadas para facilitar a navegação</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                        <span>Use imagens de alta qualidade para melhor apresentação</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                        <span>Descreva bem seus eventos para melhor SEO</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                        <span>Faça backup regular dos seus dados</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
