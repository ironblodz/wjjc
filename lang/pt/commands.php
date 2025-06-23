<?php

return [
    'title' => 'Comandos do Sistema',
    'subtitle' => 'Execute comandos Artisan através da interface web',
    'available_commands' => 'Comandos Disponíveis',
    'command_output' => 'Saída do Comando',
    'recent_executions' => 'Execuções Recentes',
    'clear_history' => 'Limpar Histórico',
    'execute' => 'Executar',
    'help' => 'Ver ajuda',
    'view_output' => 'Ver Saída',
    'no_recent_executions' => 'Nenhuma execução recente',
    'select_command' => 'Selecione um comando para executar...',
    'executing' => 'Executando comando...',
    'success' => 'Comando executado com sucesso',
    'error' => 'Erro na execução do comando',
    'communication_error' => 'Erro na comunicação',
    'clear_history_confirm' => 'Tem certeza que deseja limpar o histórico de comandos?',
    'history_cleared' => 'Histórico limpo com sucesso',
    'access_denied' => 'Acesso negado',
    'command_not_allowed' => 'Comando não permitido',
    'command_not_found' => 'Comando não encontrado',
    'help_error' => 'Erro ao obter ajuda',
    'options_available' => 'Opções disponíveis:',
    'with_options' => 'com opções:',
    'executed_at' => 'Executado em',
    'status' => [
        'success' => 'Sucesso',
        'error' => 'Erro'
    ],
    'commands' => [
        'images:cleanup' => [
            'name' => 'Limpeza de Imagens Órfãs',
            'description' => 'Remove imagens que não estão referenciadas no banco de dados'
        ],
        'cache:clear' => [
            'name' => 'Limpar Cache',
            'description' => 'Remove todos os caches da aplicação'
        ],
        'config:clear' => [
            'name' => 'Limpar Configurações',
            'description' => 'Remove o cache de configurações'
        ],
        'view:clear' => [
            'name' => 'Limpar Views',
            'description' => 'Remove o cache de views compiladas'
        ],
        'route:clear' => [
            'name' => 'Limpar Rotas',
            'description' => 'Remove o cache de rotas'
        ],
        'storage:link' => [
            'name' => 'Criar Link Simbólico',
            'description' => 'Cria link simbólico para storage público'
        ]
    ],
    'options' => [
        '--dry-run' => 'Modo de teste (não exclui arquivos)'
    ]
];
