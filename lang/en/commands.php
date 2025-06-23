<?php

return [
    'title' => 'System Commands',
    'subtitle' => 'Execute Artisan commands through the web interface',
    'available_commands' => 'Available Commands',
    'command_output' => 'Command Output',
    'recent_executions' => 'Recent Executions',
    'clear_history' => 'Clear History',
    'execute' => 'Execute',
    'help' => 'View help',
    'view_output' => 'View Output',
    'no_recent_executions' => 'No recent executions',
    'select_command' => 'Select a command to execute...',
    'executing' => 'Executing command...',
    'success' => 'Command executed successfully',
    'error' => 'Error executing command',
    'communication_error' => 'Communication error',
    'clear_history_confirm' => 'Are you sure you want to clear the command history?',
    'history_cleared' => 'History cleared successfully',
    'access_denied' => 'Access denied',
    'command_not_allowed' => 'Command not allowed',
    'command_not_found' => 'Command not found',
    'help_error' => 'Error getting help',
    'options_available' => 'Available options:',
    'with_options' => 'with options:',
    'executed_at' => 'Executed at',
    'status' => [
        'success' => 'Success',
        'error' => 'Error'
    ],
    'commands' => [
        'images:cleanup' => [
            'name' => 'Orphaned Images Cleanup',
            'description' => 'Removes images that are not referenced in the database'
        ],
        'cache:clear' => [
            'name' => 'Clear Cache',
            'description' => 'Removes all application caches'
        ],
        'config:clear' => [
            'name' => 'Clear Configuration',
            'description' => 'Removes configuration cache'
        ],
        'view:clear' => [
            'name' => 'Clear Views',
            'description' => 'Removes compiled view cache'
        ],
        'route:clear' => [
            'name' => 'Clear Routes',
            'description' => 'Removes route cache'
        ],
        'storage:link' => [
            'name' => 'Create Symbolic Link',
            'description' => 'Creates symbolic link for public storage'
        ]
    ],
    'options' => [
        '--dry-run' => 'Test mode (does not delete files)'
    ]
];
