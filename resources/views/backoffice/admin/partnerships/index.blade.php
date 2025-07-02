@extends('layouts.backoffice')

@section('title', trans('backoffice.partnerships.title'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        <i class="fas fa-handshake mr-3 text-purple-600"></i>
                        {{ trans('backoffice.partnerships.title') }}
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Gerencie as parcerias e patrocinadores do WJJC
                    </p>
                </div>
                <div>
                    <a href="{{ route('backoffice.admin.partnerships.create') }}"
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus mr-2"></i>
                        {{ trans('backoffice.partnerships.add_new') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Erro ao processar a solicitação:</p>
                        <ul class="mt-2 text-sm list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Partnerships Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($partnerships as $partnership)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 overflow-hidden">
                    <!-- Logo Section -->
                    <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-6">
                        @if($partnership->logo_path)
                            <img src="{{ asset('storage/' . $partnership->logo_path) }}"
                                 alt="{{ $partnership->name }} Logo"
                                 class="max-h-full max-w-full object-contain">
                        @else
                            <div class="text-gray-400 text-center">
                                <i class="fas fa-image text-4xl mb-2"></i>
                                <p class="text-sm">Sem logo</p>
                            </div>
                        @endif
                    </div>

                    <!-- Content Section -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $partnership->name }}</h3>
                                @if($partnership->description)
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($partnership->description, 100) }}</p>
                                @endif
                            </div>
                            <div class="ml-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($partnership->type === 'sponsor') bg-blue-100 text-blue-800
                                    @elseif($partnership->type === 'partner') bg-green-100 text-green-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                    {{ trans('backoffice.partnerships.types.' . $partnership->type) }}
                                </span>
                            </div>
                        </div>

                        <!-- Status and Order -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($partnership->is_active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                    {{ $partnership->is_active ? 'Ativo' : 'Inativo' }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-500">
                                Ordem: {{ $partnership->order }}
                            </div>
                        </div>

                        <!-- Website Link -->
                        @if($partnership->website_url)
                            <div class="mb-4">
                                <a href="{{ $partnership->website_url }}"
                                   target="_blank"
                                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    Visitar website
                                </a>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('backoffice.admin.partnerships.edit', $partnership) }}"
                                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                                    <i class="fas fa-edit mr-1"></i>
                                    {{ trans('backoffice.partnerships.edit') }}
                                </a>
                                <a href="{{ route('backoffice.admin.partnerships.show', $partnership) }}"
                                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                                    <i class="fas fa-eye mr-1"></i>
                                    Ver
                                </a>
                            </div>
                            <form action="{{ route('backoffice.admin.partnerships.destroy', $partnership) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('{{ trans('backoffice.partnerships.error.delete_confirm') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-2 border border-red-300 shadow-sm text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                    <i class="fas fa-trash mr-1"></i>
                                    {{ trans('backoffice.partnerships.delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <div class="mx-auto h-24 w-24 text-gray-400">
                            <i class="fas fa-handshake text-6xl"></i>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Nenhuma parceria encontrada</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Comece criando sua primeira parceria.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('backoffice.admin.partnerships.create') }}"
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                <i class="fas fa-plus mr-2"></i>
                                {{ trans('backoffice.partnerships.add_new') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Statistics -->
        @if($partnerships->count() > 0)
            <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-handshake text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total de Parcerias</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $partnerships->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Ativas</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $partnerships->where('is_active', true)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-star text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Patrocinadores</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $partnerships->where('type', 'sponsor')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Parceiros</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $partnerships->where('type', 'partner')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
