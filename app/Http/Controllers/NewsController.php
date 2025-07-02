<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $featured = News::where('featured', true)->orderBy('start_date', 'desc')->get();
        $featuredIds = $featured->pluck('id')->toArray();
        $others = News::where('featured', false)
            ->whereNotIn('id', $featuredIds)
            ->orderBy('start_date', 'desc')
            ->paginate(6 - $featured->count());
        // Juntar destacados e outros para a página 1
        $news = $featured->merge($others);
        // Para as próximas páginas, só paginar os não destacados normalmente
        if (request()->get('page', 1) > 1) {
            $news = News::where('featured', false)
                ->orderBy('start_date', 'desc')
                ->paginate(6);
        }
        return view('layouts.news', compact('news'));
    }
}
