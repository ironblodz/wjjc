<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Photo::count();
        $totalCategories = Category::count();
        $totalPhotos = Photo::with('images')->get()->sum(function($photo) {
            return $photo->images->count();
        });

        return view('dashboard', compact('totalEvents', 'totalCategories', 'totalPhotos'));
    }
}
