<?php

namespace App\Http\Controllers;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        // Buscar a categoria de eventos
        $competitionCategory = Category::where('name', 'Competições')->first();

        // Se a categoria existir, buscar as fotos relacionadas
        if ($competitionCategory) {
            $photos = Photo::with(['category', 'images'])
                ->where('category_id', $competitionCategory->id)
                ->get();
        } else {
            $photos = collect(); // Coleção vazia se não existir a categoria
        }

        return view('layouts.competition', compact('photos'));
    }
}

