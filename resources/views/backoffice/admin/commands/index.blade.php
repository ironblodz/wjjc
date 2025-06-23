@extends('layouts.backoffice')

@section('title', trans('commands.title'))

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-terminal mr-3 text-blue-500"></i>
                    {{ trans('commands.title') }}
                </h2>
                <p class="text-lg text-gray-600">{{ trans('commands.subtitle') }}</p>
            </div>
            <button onclick="clearHistory()" class="px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-all duration-300 font-semibold">
                <i class="fas fa-trash mr-2"></i>
                {{ trans('commands.clear_history') }}
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Available Commands -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
                <h3 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-terminal mr-3 text-blue-500"></i>
                    {{ trans('commands.available_commands') }}
                </h3>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    @foreach($commands as $commandKey => $command)
                        <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-gray-300 transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-{{ $command['color'] }}-100 text-{{ $command['color'] }}-800 mr-4">
                                            <i class="{{ $command['icon'] }} mr-2"></i>
                                            {{ $command['name'] }}
                                        </span>
                                        <code class="text-sm bg-gray-100 px-3 py-1 rounded-lg text-gray-700 font-mono">{{ $commandKey }}</code>
                                    </div>
                                    <p class="text-base text-gray-600 mb-4">{{ $command['description'] }}</p>

                                    @if(!empty($command['options']))
                                        <div class="mb-4">
                                            <p class="text-sm font-semibold text-gray-700 mb-3">{{ trans('commands.options_available') }}</p>
                                            <div class="space-y-2">
                                                @foreach($command['options'] as $option => $description)
                                                    <div class="flex items-center">
                                                        <input type="checkbox" id="{{ $commandKey }}_{{ $option }}"
                                                               class="mr-3 text-blue-600 rounded focus:ring-blue-500">
                                                        <label for="{{ $commandKey }}_{{ $option }}" class="text-sm text-gray-600">
                                                            <code class="bg-gray-100 px-2 py-1 rounded text-gray-700">{{ $option }}</code>
                                                            <span class="ml-2">{{ $description }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex space-x-3">
                                    <button onclick="showHelp('{{ $commandKey }}')"
                                            class="p-3 text-gray-400 hover:text-blue-600 transition-all duration-300 rounded-lg hover:bg-blue-50"
                                            title="{{ trans('commands.help') }}">
                                        <i class="fas fa-question-circle text-lg"></i>
                                    </button>
                                    <button onclick="executeCommand('{{ $commandKey }}')"
                                            class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-300 font-semibold">
                                        <i class="fas fa-play mr-2"></i>
                                        {{ trans('commands.execute') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Command Output -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
                <h3 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-terminal mr-3 text-green-500"></i>
                    {{ trans('commands.command_output') }}
                </h3>
            </div>
            <div class="p-8">
                <div id="command-output" class="bg-gray-900 text-green-400 p-6 rounded-xl font-mono text-base h-96 overflow-y-auto border border-gray-700">
                    <div class="text-gray-500">
                        <i class="fas fa-info-circle mr-2"></i>
                        {{ trans('commands.select_command') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Executions -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-history mr-3 text-purple-500"></i>
                {{ trans('commands.recent_executions') }}
            </h3>
        </div>
        <div class="p-8">
            @if(!empty($recentExecutions))
                <div class="space-y-6">
                    @foreach($recentExecutions as $execution)
                        <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-gray-300 transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                                   {{ $execution['exit_code'] === 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            <i class="{{ $execution['exit_code'] === 0 ? 'fas fa-check' : 'fas fa-times' }} mr-2"></i>
                                            {{ $execution['exit_code'] === 0 ? trans('commands.status.success') : trans('commands.status.error') }}
                                        </span>
                                        <span class="ml-4 text-sm text-gray-500 font-medium">
                                            {{ \Carbon\Carbon::parse($execution['executed_at'])->format('d/m/Y H:i:s') }}
                                        </span>
                                        <span class="ml-4 text-sm text-gray-400">{{ $execution['user'] }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <code class="text-base bg-gray-100 px-3 py-2 rounded-lg font-mono">{{ $execution['command'] }}</code>
                                        @if(!empty($execution['options']))
                                            <span class="text-sm text-gray-600 ml-3">
                                                {{ trans('commands.with_options') }} {{ implode(', ', array_keys($execution['options'])) }}
                                            </span>
                                        @endif
                                    </div>
                                    @if($execution['command_info'])
                                        <p class="text-base text-gray-600">{{ $execution['command_info']['name'] }}</p>
                                    @endif
                                </div>
                                <button onclick="showExecutionOutput('{{ json_encode($execution) }}')"
                                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold">
                                    {{ trans('commands.view_output') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-history text-6xl text-gray-400 mb-6"></i>
                    <p class="text-xl text-gray-500">{{ trans('commands.no_recent_executions') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para saída detalhada -->
<div id="output-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl max-w-6xl w-full max-h-[80vh] overflow-hidden shadow-2xl">
            <div class="px-8 py-6 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-gray-50 to-gray-100">
                <h3 class="text-2xl font-bold text-gray-900">{{ trans('commands.command_output') }}</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-all duration-300 p-2 rounded-lg hover:bg-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-8">
                <div id="modal-output" class="bg-gray-900 text-green-400 p-6 rounded-xl font-mono text-base max-h-96 overflow-y-auto border border-gray-700">
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function executeCommand(command) {
        // Coletar opções selecionadas
        const options = {};
        const checkboxes = document.querySelectorAll(`input[id^="${command}_"]`);
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const option = checkbox.id.replace(`${command}_`, '');
                options[option] = true;
            }
        });

        // Mostrar loading
        const output = document.getElementById('command-output');
        output.innerHTML = `
            <div class="flex items-center text-yellow-400">
                <i class="fas fa-spinner fa-spin mr-3 text-xl"></i>
                <span class="text-lg">{{ trans('commands.executing') }}</span>
            </div>
        `;

        // Executar comando
        fetch('{{ route("backoffice.admin.commands.execute") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                command: command,
                options: options
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                output.innerHTML = `
                    <div class="text-green-400">
                        <div class="mb-4 p-3 bg-green-900 bg-opacity-50 rounded-lg border border-green-700">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span class="font-semibold">Comando executado com sucesso!</span>
                        </div>
                        <pre class="whitespace-pre-wrap">${data.output}</pre>
                    </div>
                `;
            } else {
                output.innerHTML = `
                    <div class="text-red-400">
                        <div class="mb-4 p-3 bg-red-900 bg-opacity-50 rounded-lg border border-red-700">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-semibold">Erro ao executar comando</span>
                        </div>
                        <pre class="whitespace-pre-wrap">${data.message}</pre>
                    </div>
                `;
            }
        })
        .catch(error => {
            output.innerHTML = `
                <div class="text-red-400">
                    <div class="mb-4 p-3 bg-red-900 bg-opacity-50 rounded-lg border border-red-700">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span class="font-semibold">Erro de conexão</span>
                    </div>
                    <pre class="whitespace-pre-wrap">${error.message}</pre>
                </div>
            `;
        });
    }

    function showHelp(command) {
        fetch('{{ route("backoffice.admin.commands.help", "") }}/' + command)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showModal(data.help);
                } else {
                    showModal('Erro ao carregar ajuda: ' + data.message);
                }
            })
            .catch(error => {
                showModal('Erro de conexão: ' + error.message);
            });
    }

    function showExecutionOutput(execution) {
        const exec = JSON.parse(execution);
        showModal(exec.output || 'Nenhuma saída disponível');
    }

    function showModal(content) {
        document.getElementById('modal-output').innerHTML = `<pre class="whitespace-pre-wrap">${content}</pre>`;
        document.getElementById('output-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('output-modal').classList.add('hidden');
    }

    function clearHistory() {
        if (confirm('{{ trans("commands.confirm_clear_history") }}')) {
            fetch('{{ route("backoffice.admin.commands.clear-history") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Erro ao limpar histórico: ' + data.message);
                }
            })
            .catch(error => {
                alert('Erro de conexão: ' + error.message);
            });
        }
    }

    // Fechar modal com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endpush
@endsection
