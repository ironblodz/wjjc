<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deploy {--force : Force deploy without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy the application to production';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force') && !$this->confirm('Are you sure you want to deploy to production?')) {
            $this->info('Deploy cancelled.');
            return;
        }

        $this->info('🚀 Starting production deploy...');

        try {
            // 1. Clear all caches
            $this->info('🧹 Clearing caches...');
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('clear-compiled');

            // 2. Run migrations
            $this->info('🗄️ Running migrations...');
            Artisan::call('migrate', ['--force' => true]);

            // 3. Optimize for production
            $this->info('⚡ Optimizing for production...');
            Artisan::call('optimize');
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');

            // 4. Check storage link
            $this->info('🔗 Checking storage link...');
            if (!File::exists(public_path('storage'))) {
                Artisan::call('storage:link');
            }

            // 5. Verify manifest.json
            $this->info('📋 Checking manifest.json...');
            $viteManifest = public_path('build/.vite/manifest.json');
            $publicManifest = public_path('build/manifest.json');

            if (File::exists($viteManifest) && !File::exists($publicManifest)) {
                File::copy($viteManifest, $publicManifest);
                $this->info('✅ Manifest.json copied successfully');
            }

            $this->info('🎉 Deploy completed successfully!');
            $this->info('🌐 Application is ready for production!');

        } catch (\Exception $e) {
            $this->error('❌ Deploy failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
