<?php

return [
    'title' => 'Comandos del Sistema',
    'subtitle' => 'Ejecuta comandos Artisan a través de la interfaz web',
    'available_commands' => 'Comandos Disponibles',
    'command_output' => 'Salida del Comando',
    'recent_executions' => 'Ejecuciones Recientes',
    'clear_history' => 'Limpiar Historial',
    'execute' => 'Ejecutar',
    'help' => 'Ver ayuda',
    'view_output' => 'Ver Salida',
    'no_recent_executions' => 'No hay ejecuciones recientes',
    'select_command' => 'Selecciona un comando para ejecutar...',
    'executing' => 'Ejecutando comando...',
    'success' => 'Comando ejecutado exitosamente',
    'error' => 'Error al ejecutar el comando',
    'communication_error' => 'Error de comunicación',
    'clear_history_confirm' => '¿Estás seguro de que quieres limpiar el historial de comandos?',
    'history_cleared' => 'Historial limpiado exitosamente',
    'access_denied' => 'Acceso denegado',
    'command_not_allowed' => 'Comando no permitido',
    'command_not_found' => 'Comando no encontrado',
    'help_error' => 'Error al obtener ayuda',
    'options_available' => 'Opciones disponibles:',
    'with_options' => 'con opciones:',
    'executed_at' => 'Ejecutado en',
    'status' => [
        'success' => 'Éxito',
        'error' => 'Error'
    ],
    'commands' => [
        'images:cleanup' => [
            'name' => 'Limpieza de Imágenes Huérfanas',
            'description' => 'Elimina imágenes que no están referenciadas en la base de datos'
        ],
        'cache:clear' => [
            'name' => 'Limpiar Caché',
            'description' => 'Elimina todos los cachés de la aplicación'
        ],
        'config:clear' => [
            'name' => 'Limpiar Configuración',
            'description' => 'Elimina el caché de configuración'
        ],
        'view:clear' => [
            'name' => 'Limpiar Vistas',
            'description' => 'Elimina el caché de vistas compiladas'
        ],
        'route:clear' => [
            'name' => 'Limpiar Rutas',
            'description' => 'Elimina el caché de rutas'
        ],
        'storage:link' => [
            'name' => 'Crear Enlace Simbólico',
            'description' => 'Crea enlace simbólico para almacenamiento público'
        ]
    ],
    'options' => [
        '--dry-run' => 'Modo de prueba (no elimina archivos)'
    ]
];
