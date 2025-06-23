<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\BufferedOutput;

class CommandController extends Controller
{
    /**
     * Lista de comandos disponíveis
     */
    private $availableCommands = [
        'images:cleanup' => [
            'name' => 'Limpeza de Imagens Órfãs',
            'description' => 'Remove imagens que não estão referenciadas no banco de dados',
            'icon' => 'fas fa-trash',
            'color' => 'red',
            'options' => [
                '--dry-run' => 'Modo de teste (não exclui arquivos)'
            ]
        ],
        'cache:clear' => [
            'name' => 'Limpar Cache',
            'description' => 'Remove todos os caches da aplicação',
            'icon' => 'fas fa-broom',
            'color' => 'blue',
            'options' => []
        ],
        'config:clear' => [
            'name' => 'Limpar Configurações',
            'description' => 'Remove o cache de configurações',
            'icon' => 'fas fa-cog',
            'color' => 'purple',
            'options' => []
        ],
        'view:clear' => [
            'name' => 'Limpar Views',
            'description' => 'Remove o cache de views compiladas',
            'icon' => 'fas fa-eye',
            'color' => 'green',
            'options' => []
        ],
        'route:clear' => [
            'name' => 'Limpar Rotas',
            'description' => 'Remove o cache de rotas',
            'icon' => 'fas fa-route',
            'color' => 'orange',
            'options' => []
        ],
        'storage:link' => [
            'name' => 'Criar Link Simbólico',
            'description' => 'Cria link simbólico para storage público',
            'icon' => 'fas fa-link',
            'color' => 'indigo',
            'options' => []
        ]
    ];

    public function __construct()
    {
        // Carregar comandos das traduções
        $this->loadCommandsFromTranslations();
    }

    /**
     * Carregar comandos das traduções
     */
    private function loadCommandsFromTranslations(): void
    {
        $translations = trans('commands.commands');

        foreach ($this->availableCommands as $key => &$command) {
            if (isset($translations[$key])) {
                $command['name'] = $translations[$key]['name'];
                $command['description'] = $translations[$key]['description'];
            }
        }

        // Carregar opções das traduções
        $optionsTranslations = trans('commands.options');
        foreach ($this->availableCommands as &$command) {
            foreach ($command['options'] as $option => &$description) {
                if (isset($optionsTranslations[$option])) {
                    $description = $optionsTranslations[$option];
                }
            }
        }
    }

    /**
     * Display a listing of available commands.
     */
    public function index()
    {
        $commands = $this->availableCommands;
        $recentExecutions = $this->getRecentExecutions();

        return view('backoffice.admin.commands.index', compact('commands', 'recentExecutions'));
    }

    /**
     * Execute a command.
     */
    public function execute(Request $request)
    {
        $request->validate([
            'command' => 'required|string',
            'options' => 'array'
        ]);

        $command = $request->input('command');
        $options = $request->input('options', []);

        // Verificar se o comando é permitido
        if (!array_key_exists($command, $this->availableCommands)) {
            return response()->json([
                'success' => false,
                'message' => trans('commands.command_not_allowed')
            ], 403);
        }

        try {
            // Preparar argumentos e opções
            $arguments = [];
            $commandOptions = [];

            foreach ($options as $option => $value) {
                if ($value === true || $value === 'true') {
                    $commandOptions[] = $option;
                } else {
                    $commandOptions[] = "{$option}={$value}";
                }
            }

            // Executar comando
            $output = new BufferedOutput();
            $exitCode = Artisan::call($command, $arguments, $output);
            $result = $output->fetch();

            // Log da execução
            Log::info('Comando Artisan executado via backoffice', [
                'command' => $command,
                'options' => $options,
                'exit_code' => $exitCode,
                'user_id' => auth()->id(),
                'user_email' => auth()->user()->email
            ]);

            // Salvar execução no cache para histórico
            $this->saveExecution($command, $options, $exitCode, $result);

            return response()->json([
                'success' => $exitCode === 0,
                'message' => $exitCode === 0 ? trans('commands.success') : trans('commands.error'),
                'output' => $result,
                'exit_code' => $exitCode,
                'command_info' => $this->availableCommands[$command]
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao executar comando via backoffice', [
                'command' => $command,
                'options' => $options,
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro interno: ' . $e->getMessage(),
                'output' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get command help information.
     */
    public function help($command)
    {
        if (!array_key_exists($command, $this->availableCommands)) {
            return response()->json([
                'success' => false,
                'message' => trans('commands.command_not_found')
            ], 404);
        }

        try {
            $output = new BufferedOutput();
            Artisan::call($command, ['--help'], $output);
            $help = $output->fetch();

            return response()->json([
                'success' => true,
                'help' => $help,
                'command_info' => $this->availableCommands[$command]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => trans('commands.help_error') . ': ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get recent command executions.
     */
    private function getRecentExecutions(): array
    {
        $cacheKey = 'command_executions_' . auth()->id();
        return cache()->get($cacheKey, []);
    }

    /**
     * Save command execution to cache.
     */
    private function saveExecution(string $command, array $options, int $exitCode, string $output): void
    {
        $cacheKey = 'command_executions_' . auth()->id();
        $executions = cache()->get($cacheKey, []);

        $execution = [
            'command' => $command,
            'options' => $options,
            'exit_code' => $exitCode,
            'output' => $output,
            'executed_at' => now()->toISOString(),
            'user' => auth()->user()->email,
            'command_info' => $this->availableCommands[$command] ?? null
        ];

        // Adicionar no início do array
        array_unshift($executions, $execution);

        // Manter apenas os últimos 20 comandos
        $executions = array_slice($executions, 0, 20);

        cache()->put($cacheKey, $executions, now()->addDays(7));
    }

    /**
     * Clear command history.
     */
    public function clearHistory()
    {
        $cacheKey = 'command_executions_' . auth()->id();
        cache()->forget($cacheKey);

        Log::info('Histórico de comandos limpo', [
            'user_id' => auth()->id(),
            'user_email' => auth()->user()->email
        ]);

        return response()->json([
            'success' => true,
            'message' => trans('commands.history_cleared')
        ]);
    }
}
