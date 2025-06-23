<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Log;

class CleanupOrphanedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:cleanup {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up orphaned images that are not referenced in the database';

    /**
     * Execute the console command.
     */
    public function handle(ImageUploadService $imageUploadService)
    {
        $this->info('🔍 Iniciando limpeza de imagens órfãs...');

        if ($this->option('dry-run')) {
            $this->warn('⚠️  Modo DRY-RUN ativado. Nenhuma imagem será excluída.');
        }

        try {
            $result = $imageUploadService->cleanupOrphanedImages();

            if ($result['success']) {
                $orphanedCount = count($result['orphaned_files']);
                $deletedCount = $result['deleted_count'];

                if ($orphanedCount === 0) {
                    $this->info('✅ Nenhuma imagem órfã encontrada!');
                } else {
                    $this->info("📊 Estatísticas da limpeza:");
                    $this->line("   • Imagens órfãs encontradas: {$orphanedCount}");

                    if ($this->option('dry-run')) {
                        $this->line("   • Imagens que seriam excluídas: {$orphanedCount}");
                        $this->warn("   • Nenhuma imagem foi excluída (modo dry-run)");
                    } else {
                        $this->line("   • Imagens excluídas: {$deletedCount}");

                        if ($deletedCount < $orphanedCount) {
                            $remaining = $orphanedCount - $deletedCount;
                            $this->warn("   • {$remaining} imagens não puderam ser excluídas");
                        }
                    }

                    // Mostrar lista de arquivos órfãos
                    if ($orphanedCount > 0) {
                        $this->newLine();
                        $this->info('📋 Lista de imagens órfãs:');
                        foreach ($result['orphaned_files'] as $file) {
                            $this->line("   • {$file}");
                        }
                    }
                }

                // Log da operação
                Log::info('Limpeza de imagens órfãs executada via comando', [
                    'orphaned_count' => $orphanedCount,
                    'deleted_count' => $deletedCount,
                    'dry_run' => $this->option('dry-run')
                ]);

            } else {
                $this->error('❌ Erro durante a limpeza: ' . $result['error']);
                return 1;
            }

        } catch (\Exception $e) {
            $this->error('❌ Erro inesperado: ' . $e->getMessage());
            Log::error('Erro no comando de limpeza de imagens', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }

        $this->newLine();
        $this->info('✨ Limpeza concluída!');

        return 0;
    }
}
