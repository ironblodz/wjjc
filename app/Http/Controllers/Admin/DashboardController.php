<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Category;
use App\Models\User;
use App\Models\PhotoImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics.
     */
    public function index()
    {
        try {
            // Estatísticas básicas
            $stats = [
                'total_photos' => Photo::count(),
                'total_categories' => Category::count(),
                'total_users' => User::count(),
                'total_images' => PhotoImage::count(),
            ];

            // Estatísticas por categoria
            $categoryStats = Category::withCount('photos')
                ->withSum('photos', DB::raw('(SELECT COUNT(*) FROM photo_images WHERE photo_images.photo_id = photos.id)'))
                ->orderBy('photos_count', 'desc')
                ->limit(5)
                ->get();

            // Estatísticas de upload por mês (últimos 6 meses)
            $monthlyStats = $this->getMonthlyStats();

            // Estatísticas de atividade recente
            $recentActivity = $this->getRecentActivity();

            // Estatísticas de armazenamento
            $storageStats = $this->getStorageStats();

            // Log da visita ao dashboard
            Log::info('Dashboard acessado', [
                'user_id' => auth()->id(),
                'user_email' => auth()->user()->email ?? 'unknown',
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            return view('backoffice.dashboard', compact(
                'stats',
                'categoryStats',
                'monthlyStats',
                'recentActivity',
                'storageStats'
            ));

        } catch (\Exception $e) {
            Log::error('Erro ao carregar dashboard', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Retornar dados básicos em caso de erro
            $stats = [
                'total_photos' => 0,
                'total_categories' => 0,
                'total_users' => 0,
                'total_images' => 0,
            ];

            return view('backoffice.dashboard', compact('stats'));
        }
    }

    /**
     * Get monthly statistics for the last 6 months
     */
    private function getMonthlyStats(): array
    {
        $months = [];
        $photosData = [];
        $imagesData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');
            $months[] = $monthName;

            // Contar fotos criadas no mês
            $photosCount = Photo::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $photosData[] = $photosCount;

            // Contar imagens criadas no mês
            $imagesCount = PhotoImage::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $imagesData[] = $imagesCount;
        }

        return [
            'months' => $months,
            'photos' => $photosData,
            'images' => $imagesData
        ];
    }

    /**
     * Get recent activity
     */
    private function getRecentActivity(): array
    {
        $activities = [];

        // Fotos recentes
        $recentPhotos = Photo::with('category')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        foreach ($recentPhotos as $photo) {
            $activities[] = [
                'type' => 'photo_created',
                'title' => 'Nova galeria criada',
                'description' => "Galeria '{$photo->title}' criada na categoria {$photo->category->name}",
                'datetime' => $photo->created_at,
                'icon' => 'fas fa-images',
                'color' => 'blue'
            ];
        }

        // Categorias recentes
        $recentCategories = Category::orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($recentCategories as $category) {
            $activities[] = [
                'type' => 'category_created',
                'title' => 'Nova categoria criada',
                'description' => "Categoria '{$category->name}' criada",
                'datetime' => $category->created_at,
                'icon' => 'fas fa-tag',
                'color' => 'green'
            ];
        }

        // Ordenar por data (mais recente primeiro)
        usort($activities, function($a, $b) {
            return $b['datetime']->timestamp - $a['datetime']->timestamp;
        });

        return array_slice($activities, 0, 8);
    }

    /**
     * Get storage statistics
     */
    private function getStorageStats(): array
    {
        try {
            // Estimar tamanho das imagens baseado no número de registros
            $totalImages = PhotoImage::count();
            $estimatedSizePerImage = 2 * 1024 * 1024; // 2MB por imagem (estimativa)
            $estimatedTotalSize = $totalImages * $estimatedSizePerImage;

            // Categorias com mais imagens
            $topCategories = Category::withCount('photos')
                ->withSum('photos', DB::raw('(SELECT COUNT(*) FROM photo_images WHERE photo_images.photo_id = photos.id)'))
                ->orderBy('photos_sum', 'desc')
                ->limit(3)
                ->get();

            return [
                'total_images' => $totalImages,
                'estimated_size' => $this->formatBytes($estimatedTotalSize),
                'top_categories' => $topCategories
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao calcular estatísticas de armazenamento', [
                'error' => $e->getMessage()
            ]);

            return [
                'total_images' => 0,
                'estimated_size' => '0 B',
                'top_categories' => collect()
            ];
        }
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

    /**
     * Get API statistics for AJAX requests
     */
    public function getStats()
    {
        try {
            $stats = [
                'total_photos' => Photo::count(),
                'total_categories' => Category::count(),
                'total_users' => User::count(),
                'total_images' => PhotoImage::count(),
                'photos_this_month' => Photo::whereMonth('created_at', Carbon::now()->month)->count(),
                'images_this_month' => PhotoImage::whereMonth('created_at', Carbon::now()->month)->count(),
            ];

            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao obter estatísticas via API', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Erro ao carregar estatísticas'
            ], 500);
        }
    }
}
