<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $featured = News::where('featured', true)
            ->orderBy('start_date', 'desc')
            ->get();

        $news = News::where('featured', false)
            ->orderBy('start_date', 'desc')
            ->paginate(6);

        return view('layouts.news', compact('featured', 'news'));
    }
}
