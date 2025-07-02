@extends('layouts.backoffice')

@section('title', $partnership->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        <i class="fas fa-eye mr-3 text-purple-600"></i>
                        {{ $partnership->name }}
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Detalhes da parceria
                    </p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('backoffice.admin.partnerships.edit', $partnership) }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        {{ trans('backoffice.partnerships.edit') }}
                    </a>
                    <a href="{{ route('backoffice.admin.partnerships.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-8">
                <!-- Logo Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-image mr-2 text-purple-600"></i>
                        Logo da Parceria
                    </h3>

                    @if($partnership->logo_path)
                        <div class="flex justify-center">
                            <img src="{{ asset('storage/' . $partnership->logo_path) }}"
                                 alt="{{ $partnership->name }} Logo"
                                 class="max-h-48 max-w-full object-contain rounded-lg shadow-lg border border-gray-200">
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <div class="mx-auto h-16 w-16 text-gray-400 mb-4">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                            <p class="text-gray-500">Nenhum logo disponível</p>
                        </div>
                    @endif
                </div>

                <!-- Basic Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-purple-600"></i>
                        Informações Básicas
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ trans('backoffice.partnerships.fields.name') }}
                            </label>
                            <p class="text-lg font-semibold text-gray-900">{{ $partnership->name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ trans('backoffice.partnerships.fields.type') }}
                            </label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($partnership->type === 'sponsor') bg-blue-100 text-blue-800
                                @elseif($partnership->type === 'partner') bg-green-100 text-green-800
                                @else bg-purple-100 text-purple-800 @endif">
                                {{ trans('backoffice.partnerships.types.' . $partnership->type) }}
                            </span>
                        </div>
                    </div>

                    @if($partnership->description)
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ trans('backoffice.partnerships.fields.description') }}
                            </label>
                            <p class="text-gray-900 bg-gray-50 p-4 rounded-lg">{{ $partnership->description }}</p>
                        </div>
                    @endif

                    @if($partnership->website_url)
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ trans('backoffice.partnerships.fields.website_url') }}
                            </label>
                            <a href="{{ $partnership->website_url }}"
                               target="_blank"
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                {{ $partnership->website_url }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Settings -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-cog mr-2 text-purple-600"></i>
                        Configurações
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ trans('backoffice.partnerships.fields.is_active') }}
                            </label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($partnership->is_active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                <i class="fas fa-circle mr-2 text-xs"></i>
                                {{ $partnership->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ trans('backoffice.partnerships.fields.order') }}
                            </label>
                            <p class="text-lg font-semibold text-gray-900">{{ $partnership->order }}</p>
                        </div>
                    </div>
                </div>

                <!-- Timestamps -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-clock mr-2 text-purple-600"></i>
                        Informações do Sistema
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Criado em
                            </label>
                            <p class="text-gray-900">{{ $partnership->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Última atualização
                            </label>
                            <p class="text-gray-900">{{ $partnership->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-6 flex items-center justify-between">
                <div class="flex space-x-3">
                    <a href="{{ route('backoffice.admin.partnerships.edit', $partnership) }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        {{ trans('backoffice.partnerships.edit') }}
                    </a>
                    <form action="{{ route('backoffice.admin.partnerships.destroy', $partnership) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('{{ trans('backoffice.partnerships.error.delete_confirm') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <i class="fas fa-trash mr-2"></i>
                            {{ trans('backoffice.partnerships.delete') }}
                        </button>
                    </form>
                </div>
                <a href="{{ route('backoffice.admin.partnerships.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Voltar à Lista
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
