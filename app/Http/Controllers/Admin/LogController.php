<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the logs.
     */
    public function index(Request $request)
    {
        $logFiles = $this->getLogFiles();
        $selectedFile = $request->get('file', 'laravel.log');
        $logs = $this->getLogs($selectedFile);

        // Estatísticas dos logs
        $stats = $this->getLogStats($selectedFile);

        return view('backoffice.admin.logs.index', compact('logFiles', 'selectedFile', 'logs', 'stats'));
    }

    /**
     * Download a log file
     */
    public function download($filename)
    {
        $logPath = storage_path('logs/' . $filename);

        if (!File::exists($logPath)) {
            return redirect()->back()->with('error', 'Arquivo de log não encontrado.');
        }

        return response()->download($logPath);
    }

    /**
     * Clear a log file
     */
    public function clear($filename)
    {
        $logPath = storage_path('logs/' . $filename);

        if (!File::exists($logPath)) {
            return redirect()->back()->with('error', 'Arquivo de log não encontrado.');
        }

        File::put($logPath, '');

        Log::info('Log file cleared by admin', ['file' => $filename]);

        return redirect()->back()->with('success', 'Arquivo de log limpo com sucesso.');
    }

    /**
     * Get all log files
     */
    private function getLogFiles(): array
    {
        $logPath = storage_path('logs');
        $files = File::files($logPath);

        $logFiles = [];
        foreach ($files as $file) {
            if ($file->getExtension() === 'log') {
                $logFiles[] = [
                    'name' => $file->getFilename(),
                    'size' => $this->formatBytes($file->getSize()),
                    'modified' => $file->getMTime()
                ];
            }
        }

        // Ordenar por data de modificação (mais recente primeiro)
        usort($logFiles, function($a, $b) {
            return $b['modified'] - $a['modified'];
        });

        return $logFiles;
    }

    /**
     * Get logs from a specific file
     */
    private function getLogs(string $filename): array
    {
        $logPath = storage_path('logs/' . $filename);

        if (!File::exists($logPath)) {
            return [];
        }

        $content = File::get($logPath);
        $lines = explode("\n", $content);

        $logs = [];
        $currentLog = '';

        foreach ($lines as $line) {
            if (empty(trim($line))) continue;

            // Verifica se é uma nova entrada de log (começa com data)
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $line)) {
                if (!empty($currentLog)) {
                    $logs[] = $this->parseLogEntry($currentLog);
                }
                $currentLog = $line;
            } else {
                $currentLog .= "\n" . $line;
            }
        }

        // Adiciona a última entrada
        if (!empty($currentLog)) {
            $logs[] = $this->parseLogEntry($currentLog);
        }

        // Ordenar por data (mais recente primeiro)
        usort($logs, function($a, $b) {
            return strtotime($b['datetime']) - strtotime($a['datetime']);
        });

        return array_slice($logs, 0, 100); // Limitar a 100 entradas
    }

    /**
     * Parse a log entry
     */
    private function parseLogEntry(string $entry): array
    {
        $lines = explode("\n", $entry);
        $firstLine = $lines[0];

        // Extrair informações da primeira linha
        preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) \[(\w+)\] (\w+)\.(\w+): (.+)$/', $firstLine, $matches);

        if (count($matches) >= 6) {
            $datetime = $matches[1];
            $level = $matches[2];
            $context = $matches[3];
            $channel = $matches[4];
            $message = $matches[5];

            // Determinar cor baseada no nível
            $color = $this->getLogLevelColor($level);

            return [
                'datetime' => $datetime,
                'level' => $level,
                'context' => $context,
                'channel' => $channel,
                'message' => $message,
                'full_entry' => $entry,
                'color' => $color,
                'icon' => $this->getLogLevelIcon($level)
            ];
        }

        return [
            'datetime' => now()->format('Y-m-d H:i:s'),
            'level' => 'unknown',
            'context' => 'unknown',
            'channel' => 'unknown',
            'message' => $entry,
            'full_entry' => $entry,
            'color' => 'gray',
            'icon' => 'fas fa-question'
        ];
    }

    /**
     * Get log statistics
     */
    private function getLogStats(string $filename): array
    {
        $logs = $this->getLogs($filename);

        $stats = [
            'total' => count($logs),
            'error' => 0,
            'warning' => 0,
            'info' => 0,
            'debug' => 0,
            'critical' => 0,
            'alert' => 0,
            'emergency' => 0
        ];

        foreach ($logs as $log) {
            $level = strtolower($log['level']);
            if (isset($stats[$level])) {
                $stats[$level]++;
            }
        }

        return $stats;
    }

    /**
     * Get color for log level
     */
    private function getLogLevelColor(string $level): string
    {
        return match(strtolower($level)) {
            'emergency', 'alert', 'critical' => 'red',
            'error' => 'orange',
            'warning' => 'yellow',
            'info' => 'blue',
            'debug' => 'gray',
            default => 'gray'
        };
    }

    /**
     * Get icon for log level
     */
    private function getLogLevelIcon(string $level): string
    {
        return match(strtolower($level)) {
            'emergency', 'alert', 'critical' => 'fas fa-exclamation-triangle',
            'error' => 'fas fa-times-circle',
            'warning' => 'fas fa-exclamation-circle',
            'info' => 'fas fa-info-circle',
            'debug' => 'fas fa-bug',
            default => 'fas fa-question'
        };
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes): string
    {
        if ($bytes === 0) return '0 B';

        $units = ['B', 'KB', 'MB', 'GB'];
        $factor = floor(log($bytes, 1024));

        return round($bytes / pow(1024, $factor), 2) . ' ' . $units[$factor];
    }
}
