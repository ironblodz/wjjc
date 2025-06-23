@extends('layouts.backoffice')

@section('title', 'Logs do Sistema')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Logs do Sistema</h2>
                <p class="mt-1 text-sm text-gray-600">Visualize e gerencie os logs da aplicação</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('backoffice.admin.logs.download', $selectedFile) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>
                    Download
                </a>
                <form action="{{ route('backoffice.admin.logs.clear', $selectedFile) }}" method="POST" class="inline"
                      onsubmit="return confirm('Tem certeza que deseja limpar este arquivo de log?')">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>
                        Limpar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- File Selector -->
    <div class="mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-file-alt mr-2 text-blue-500"></i>
                Selecionar Arquivo de Log
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($logFiles as $file)
                    <a href="{{ route('backoffice.admin.logs.index', ['file' => $file['name']]) }}"
                       class="block p-4 border rounded-lg hover:border-blue-500 transition-colors duration-200 {{ $selectedFile === $file['name'] ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $file['name'] }}</h4>
                                <p class="text-sm text-gray-500">{{ $file['size'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400">{{ date('d/m/Y H:i', $file['modified']) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-chart-bar mr-2 text-green-500"></i>
                Estatísticas do Log
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
                    <div class="text-sm text-gray-600">Total</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $stats['emergency'] + $stats['alert'] + $stats['critical'] }}</div>
                    <div class="text-sm text-gray-600">Críticos</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-orange-600">{{ $stats['error'] }}</div>
                    <div class="text-sm text-gray-600">Erros</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['warning'] }}</div>
                    <div class="text-sm text-gray-600">Avisos</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $stats['info'] }}</div>
                    <div class="text-sm text-gray-600">Info</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-600">{{ $stats['debug'] }}</div>
                    <div class="text-sm text-gray-600">Debug</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Entries -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-list mr-2 text-purple-500"></i>
                Entradas do Log - {{ $selectedFile }}
            </h3>
        </div>

        <div class="overflow-x-auto">
            <div class="space-y-2 p-6">
                @forelse($logs as $log)
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $log['color'] }}-100 text-{{ $log['color'] }}-800">
                                        <i class="{{ $log['icon'] }} mr-1"></i>
                                        {{ strtoupper($log['level']) }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $log['datetime'] }}</span>
                                    <span class="text-sm text-gray-400">{{ $log['context'] }}.{{ $log['channel'] }}</span>
                                </div>
                                <div class="text-sm text-gray-900 font-mono">
                                    {{ $log['message'] }}
                                </div>
                                @if(strlen($log['full_entry']) > 200)
                                    <button onclick="toggleLogDetails(this)"
                                            class="mt-2 text-xs text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        <i class="fas fa-chevron-down mr-1"></i>
                                        Ver detalhes
                                    </button>
                                    <div class="hidden mt-2 p-3 bg-gray-100 rounded text-xs font-mono text-gray-700 whitespace-pre-wrap">
                                        {{ $log['full_entry'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-file-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500">Nenhuma entrada de log encontrada</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleLogDetails(button) {
        const details = button.nextElementSibling;
        const icon = button.querySelector('i');

        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
            button.innerHTML = '<i class="fas fa-chevron-up mr-1"></i>Ocultar detalhes';
        } else {
            details.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
            button.innerHTML = '<i class="fas fa-chevron-down mr-1"></i>Ver detalhes';
        }
    }
</script>
@endpush
@endsection
