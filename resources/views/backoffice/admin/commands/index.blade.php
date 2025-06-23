@extends('layouts.backoffice')

@section('title', trans('commands.title'))

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ trans('commands.title') }}</h2>
                <p class="mt-1 text-sm text-gray-600">{{ trans('commands.subtitle') }}</p>
            </div>
            <button onclick="clearHistory()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-trash mr-2"></i>
                {{ trans('commands.clear_history') }}
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Available Commands -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-terminal mr-2 text-blue-500"></i>
                    {{ trans('commands.available_commands') }}
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($commands as $commandKey => $command)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-gray-300 transition-colors duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $command['color'] }}-100 text-{{ $command['color'] }}-800 mr-3">
                                            <i class="{{ $command['icon'] }} mr-1"></i>
                                            {{ $command['name'] }}
                                        </span>
                                        <code class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-700">{{ $commandKey }}</code>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">{{ $command['description'] }}</p>

                                    @if(!empty($command['options']))
                                        <div class="mb-3">
                                            <p class="text-xs font-medium text-gray-700 mb-2">{{ trans('commands.options_available') }}</p>
                                            <div class="space-y-1">
                                                @foreach($command['options'] as $option => $description)
                                                    <div class="flex items-center">
                                                        <input type="checkbox" id="{{ $commandKey }}_{{ $option }}"
                                                               class="mr-2 text-blue-600 rounded focus:ring-blue-500">
                                                        <label for="{{ $commandKey }}_{{ $option }}" class="text-xs text-gray-600">
                                                            <code class="bg-gray-100 px-1 rounded">{{ $option }}</code>
                                                            <span class="ml-1">{{ $description }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    <button onclick="showHelp('{{ $commandKey }}')"
                                            class="p-2 text-gray-400 hover:text-blue-600 transition-colors duration-200"
                                            title="{{ trans('commands.help') }}">
                                        <i class="fas fa-question-circle"></i>
                                    </button>
                                    <button onclick="executeCommand('{{ $commandKey }}')"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm">
                                        <i class="fas fa-play mr-1"></i>
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
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-terminal mr-2 text-green-500"></i>
                    {{ trans('commands.command_output') }}
                </h3>
            </div>
            <div class="p-6">
                <div id="command-output" class="bg-gray-900 text-green-400 p-4 rounded-lg font-mono text-sm h-96 overflow-y-auto">
                    <div class="text-gray-500">
                        <i class="fas fa-info-circle mr-2"></i>
                        {{ trans('commands.select_command') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Executions -->
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-history mr-2 text-purple-500"></i>
                {{ trans('commands.recent_executions') }}
            </h3>
        </div>
        <div class="p-6">
            @if(!empty($recentExecutions))
                <div class="space-y-4">
                    @foreach($recentExecutions as $execution)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                   {{ $execution['exit_code'] === 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            <i class="{{ $execution['exit_code'] === 0 ? 'fas fa-check' : 'fas fa-times' }} mr-1"></i>
                                            {{ $execution['exit_code'] === 0 ? trans('commands.status.success') : trans('commands.status.error') }}
                                        </span>
                                        <span class="ml-3 text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($execution['executed_at'])->format('d/m/Y H:i:s') }}
                                        </span>
                                        <span class="ml-3 text-sm text-gray-400">{{ $execution['user'] }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <code class="text-sm bg-gray-100 px-2 py-1 rounded">{{ $execution['command'] }}</code>
                                        @if(!empty($execution['options']))
                                            <span class="text-sm text-gray-600 ml-2">
                                                {{ trans('commands.with_options') }} {{ implode(', ', array_keys($execution['options'])) }}
                                            </span>
                                        @endif
                                    </div>
                                    @if($execution['command_info'])
                                        <p class="text-sm text-gray-600">{{ $execution['command_info']['name'] }}</p>
                                    @endif
                                </div>
                                <button onclick="showExecutionOutput('{{ json_encode($execution) }}')"
                                        class="px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors duration-200 text-sm">
                                    {{ trans('commands.view_output') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-history text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">{{ trans('commands.no_recent_executions') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para saída detalhada -->
<div id="output-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl max-w-4xl w-full max-h-[80vh] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">{{ trans('commands.command_output') }}</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6">
                <div id="modal-output" class="bg-gray-900 text-green-400 p-4 rounded-lg font-mono text-sm max-h-96 overflow-y-auto">
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
                <i class="fas fa-spinner fa-spin mr-2"></i>
                {{ trans('commands.executing') }}
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
                        <div class="mb-2">
                            <i class="fas fa-check-circle mr-2"></i>
                            ${data.message}
                        </div>
                        <div class="border-t border-gray-700 pt-2 mt-2">
                            <pre class="whitespace-pre-wrap">${data.output}</pre>
                        </div>
                    </div>
                `;
            } else {
                output.innerHTML = `
                    <div class="text-red-400">
                        <div class="mb-2">
                            <i class="fas fa-times-circle mr-2"></i>
                            ${data.message}
                        </div>
                        <div class="border-t border-gray-700 pt-2 mt-2">
                            <pre class="whitespace-pre-wrap">${data.output}</pre>
                        </div>
                    </div>
                `;
            }
        })
        .catch(error => {
            output.innerHTML = `
                <div class="text-red-400">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ trans('commands.communication_error') }}: ${error.message}
                </div>
            `;
        });
    }

    function showHelp(command) {
        fetch(`{{ route('backoffice.admin.commands.help', '') }}/${command}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const output = document.getElementById('command-output');
                output.innerHTML = `
                    <div class="text-blue-400">
                        <div class="mb-2">
                            <i class="fas fa-question-circle mr-2"></i>
                            {{ trans('commands.help') }} para: ${data.command_info.name}
                        </div>
                        <div class="border-t border-gray-700 pt-2 mt-2">
                            <pre class="whitespace-pre-wrap">${data.help}</pre>
                        </div>
                    </div>
                `;
            } else {
                alert('{{ trans('commands.help_error') }}: ' + data.message);
            }
        })
        .catch(error => {
            alert('{{ trans('commands.communication_error') }}: ' + error.message);
        });
    }

    function showExecutionOutput(executionJson) {
        const execution = JSON.parse(executionJson);
        const modal = document.getElementById('output-modal');
        const modalOutput = document.getElementById('modal-output');

        modalOutput.innerHTML = `
            <div class="mb-4">
                <div class="flex items-center mb-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                               ${execution.exit_code === 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        <i class="${execution.exit_code === 0 ? 'fas fa-check' : 'fas fa-times'} mr-1"></i>
                        ${execution.exit_code === 0 ? '{{ trans('commands.status.success') }}' : '{{ trans('commands.status.error') }}'}
                    </span>
                    <span class="ml-3 text-sm text-gray-500">
                        ${new Date(execution.executed_at).toLocaleString('pt-BR')}
                    </span>
                </div>
                <div class="mb-2">
                    <code class="text-sm bg-gray-100 px-2 py-1 rounded text-gray-700">${execution.command}</code>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-2">
                <pre class="whitespace-pre-wrap">${execution.output}</pre>
            </div>
        `;

        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('output-modal').classList.add('hidden');
    }

    function clearHistory() {
        if (confirm('{{ trans('commands.clear_history_confirm') }}')) {
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
                    alert('{{ trans('commands.help_error') }}: ' + data.message);
                }
            })
            .catch(error => {
                alert('{{ trans('commands.communication_error') }}: ' + error.message);
            });
        }
    }

    // Fechar modal ao clicar fora
    document.getElementById('output-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
@endsection
