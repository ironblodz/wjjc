<?php

use App\Http\Controllers\ContactController;

use App\Http\Controllers\PagesController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CommandController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Models\News;

Route::get('/', function () {
    $featured = News::where('featured', true)->orderBy('start_date', 'desc')->take(3)->get();
    $remaining = 3 - $featured->count();
    $news = $featured->all();
    if ($remaining > 0) {
        $others = News::where('featured', false)
            ->orderBy('start_date', 'desc')
            ->take($remaining)
            ->get();
        $news = array_merge($news, $others->all());
    }
    $carouselSlides = \App\Models\CarouselSlide::where('active', true)->orderBy('order')->get();
    return view('layouts.index', ['news' => $news, 'carouselSlides' => $carouselSlides]);
})->name('index');

Route::get('/home', function () {
    $news = News::orderBy('start_date', 'desc')->take(3)->get();
    return view('layouts.index', compact('news'));
})->name('home');

Route::get('/contact', [PagesController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/dojos', [PagesController::class, 'showDojos'])->name('dojos.show');

Route::get('/dtn', [PagesController::class, 'showDtn'])->name('dtn.show');

Route::get('/founder', [PagesController::class, 'showFounder'])->name('founder.show');
Route::get('/gallery', [PagesController::class, 'showGallery'])->name('gallery.show');

Route::get('/affiliations', [PagesController::class, 'showAffiliations'])->name('affiliations.show');
Route::get('/association', [PagesController::class, 'showAssociation'])->name('association.show');
Route::get('/partnerships', [PagesController::class, 'showSponsors'])->name('sponsors.show');

Route::get('/kishido', [PagesController::class, 'showKishido'])->name('kishido.show');

Route::get('/wjjc', [PagesController::class, 'showWJJC'])->name('wjjc.show');

Route::get('/wjjcportugal', [PagesController::class, 'showWJJCPT'])->name('wjjcpt.show');

Route::get('/events', [App\Http\Controllers\EventsController::class, 'index'])->name('event.show');

Route::get('/competition', [App\Http\Controllers\CompetitionController::class, 'index'])->name('competition.show');

Route::get('/wjjcgallery', [PagesController::class, 'showWjjcGallery'])->name('wjjcgallery.show');

Route::get('/workout', [App\Http\Controllers\WorkoutController::class, 'index'])->name('workout.show');

Route::get('/certification', [PagesController::class, 'showCertification'])->name('certification.show');

Route::get('/logo', [PagesController::class, 'showLogo'])->name('logo.show');

Route::get('/news', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index');

Route::get('/lang/{locale}', function ($locale) {
    // Salve o idioma escolhido na sessão
    session(['locale' => $locale]);

    // Redirecione de volta para a página anterior
    return back();
})->name('change.language');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('backoffice/admin')->name('backoffice.admin.')->group(function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/stats', [DashboardController::class, 'getStats'])->name('stats');

        // Rotas para Photos
        Route::resource('photos', PhotoController::class);
        // Rotas para Categories
        Route::resource('categories', CategoryController::class);
        // Rota para deletar imagens
        Route::delete('photos/images/{imageId}', [PhotoController::class, 'deleteImage'])
            ->name('photos.images.delete');

        // Rotas para Logs
        Route::get('logs', [LogController::class, 'index'])->name('logs.index');
        Route::get('logs/download/{filename}', [LogController::class, 'download'])->name('logs.download');
        Route::post('logs/clear/{filename}', [LogController::class, 'clear'])->name('logs.clear');

        // Rotas para Comandos
        Route::get('commands', [CommandController::class, 'index'])->name('commands.index');
        Route::post('commands/execute', [CommandController::class, 'execute'])->middleware('command.execution')->name('commands.execute');
        Route::get('commands/help/{command}', [CommandController::class, 'help'])->name('commands.help');
        Route::post('commands/clear-history', [CommandController::class, 'clearHistory'])->middleware('command.execution')->name('commands.clear-history');

        // Rotas para News
        Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);

        // Rotas para Partnerships
        Route::resource('partnerships', \App\Http\Controllers\Admin\PartnershipController::class);

        // Rotas para Carousel Slides
        Route::resource('carousel-slides', \App\Http\Controllers\Admin\CarouselSlideController::class);
    });
});
require __DIR__ . '/auth.php';
