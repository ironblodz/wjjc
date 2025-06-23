@extends('layouts.backoffice')

@section('title', 'Logs do Sistema')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-file-alt mr-3 text-blue-500"></i>
                    Logs do Sistema
                </h2>
                <p class="text-lg text-gray-600">Visualize e gerencie os logs da aplicação</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('backoffice.admin.logs.download', $selectedFile) }}"
                   class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-300 font-semibold">
                    <i class="fas fa-download mr-2"></i>
                    Download
                </a>
                <form action="{{ route('backoffice.admin.logs.clear', $selectedFile) }}" method="POST" class="inline"
                      onsubmit="return confirm('Tem certeza que deseja limpar este arquivo de log?')">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-300 font-semibold">
                        <i class="fas fa-trash mr-2"></i>
                        Limpar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- File Selector -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">
            <i class="fas fa-file-alt mr-3 text-blue-500"></i>
            Selecionar Arquivo de Log
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($logFiles as $file)
                <a href="{{ route('backoffice.admin.logs.index', ['file' => $file['name']]) }}"
                   class="block p-6 border-2 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-300 {{ $selectedFile === $file['name'] ? 'border-blue-500 bg-blue-50 shadow-lg' : 'border-gray-200' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-semibold text-gray-900 text-lg">{{ $file['name'] }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $file['size'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400">{{ date('d/m/Y H:i', $file['modified']) }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">
            <i class="fas fa-chart-bar mr-3 text-green-500"></i>
            Estatísticas do Log
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-6">
            <div class="text-center p-4 bg-gray-50 rounded-xl">
                <div class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</div>
                <div class="text-sm text-gray-600 mt-1">Total</div>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-xl">
                <div class="text-3xl font-bold text-red-600">{{ $stats['emergency'] + $stats['alert'] + $stats['critical'] }}</div>
                <div class="text-sm text-gray-600 mt-1">Críticos</div>
            </div>
            <div class="text-center p-4 bg-orange-50 rounded-xl">
                <div class="text-3xl font-bold text-orange-600">{{ $stats['error'] }}</div>
                <div class="text-sm text-gray-600 mt-1">Erros</div>
            </div>
            <div class="text-center p-4 bg-yellow-50 rounded-xl">
                <div class="text-3xl font-bold text-yellow-600">{{ $stats['warning'] }}</div>
                <div class="text-sm text-gray-600 mt-1">Avisos</div>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-xl">
                <div class="text-3xl font-bold text-blue-600">{{ $stats['info'] }}</div>
                <div class="text-sm text-gray-600 mt-1">Info</div>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-xl">
                <div class="text-3xl font-bold text-gray-600">{{ $stats['debug'] }}</div>
                <div class="text-sm text-gray-600 mt-1">Debug</div>
            </div>
        </div>
    </div>

    <!-- Log Entries -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-list mr-3 text-purple-500"></i>
                Entradas do Log - {{ $selectedFile }}
            </h3>
        </div>

        <div class="overflow-x-auto">
            <div class="space-y-4 p-8">
                @forelse($logs as $log)
                    <div class="border-2 border-gray-200 rounded-xl p-6 hover:bg-gray-50 transition-all duration-300">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-4 mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-{{ $log['color'] }}-100 text-{{ $log['color'] }}-800">
                                        <i class="{{ $log['icon'] }} mr-2"></i>
                                        {{ strtoupper($log['level']) }}
                                    </span>
                                    <span class="text-sm text-gray-500 font-medium">{{ $log['datetime'] }}</span>
                                    <span class="text-sm text-gray-400 font-mono">{{ $log['context'] }}.{{ $log['channel'] }}</span>
                                </div>
                                <div class="text-base text-gray-900 font-mono leading-relaxed">
                                    {{ $log['message'] }}
                                </div>
                                @if(strlen($log['full_entry']) > 200)
                                    <button onclick="toggleLogDetails(this)"
                                            class="mt-3 text-sm text-blue-600 hover:text-blue-800 transition-all duration-300 font-semibold">
                                        <i class="fas fa-chevron-down mr-2"></i>
                                        Ver detalhes
                                    </button>
                                    <div class="hidden mt-4 p-4 bg-gray-100 rounded-xl text-sm font-mono text-gray-700 whitespace-pre-wrap border border-gray-200">
                                        {{ $log['full_entry'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-file-alt text-6xl text-gray-400 mb-6"></i>
                        <p class="text-xl text-gray-500">Nenhuma entrada de log encontrada</p>
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
            button.innerHTML = '<i class="fas fa-chevron-up mr-2"></i>Ocultar detalhes';
        } else {
            details.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
            button.innerHTML = '<i class="fas fa-chevron-down mr-2"></i>Ver detalhes';
        }
    }
</script>
@endpush
@endsection
