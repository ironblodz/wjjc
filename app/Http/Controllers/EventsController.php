<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        // Buscar a categoria de eventos
        $eventCategory = Category::where('name', 'Eventos')->first();

        // Se a categoria existir, buscar as fotos relacionadas
        if ($eventCategory) {
            $photos = Photo::with(['category', 'images'])
                ->where('category_id', $eventCategory->id)
                ->get();
        } else {
            $photos = collect(); // Coleção vazia se não existir a categoria
        }

        return view('layouts.events', compact('photos'));
    }
}
