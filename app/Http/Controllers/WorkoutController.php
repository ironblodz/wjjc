<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // Buscar a categoria Treino
        $treinoCategory = Category::where('name', 'Treinos')->first();

        // Se a categoria existir, buscar apenas as fotos dessa categoria
        if ($treinoCategory) {
            $photos = Photo::with('category', 'images')
                ->where('category_id', $treinoCategory->id)
                ->get();
        } else {
            $photos = collect(); // Coleção vazia se não existir a categoria
        }

        return view('layouts.workout', compact('categories', 'photos'));
    }
}
