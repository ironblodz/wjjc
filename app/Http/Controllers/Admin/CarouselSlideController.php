<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;

class CarouselSlideController extends Controller
{
    public function index()
    {
        $slides = CarouselSlide::orderBy('order')->get();
        return view('admin.carousel_slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.carousel_slides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('carousel', 'public');
        }
        CarouselSlide::create($data);
        return redirect()->route('backoffice.admin.carousel-slides.index')->with('success', 'Slide criado com sucesso!');
    }

    public function edit(CarouselSlide $carouselSlide)
    {
        return view('admin.carousel_slides.edit', compact('carouselSlide'));
    }

    public function update(Request $request, CarouselSlide $carouselSlide)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('carousel', 'public');
        }
        $carouselSlide->update($data);
        return redirect()->route('backoffice.admin.carousel-slides.index')->with('success', 'Slide atualizado com sucesso!');
    }

    public function destroy(CarouselSlide $carouselSlide)
    {
        $carouselSlide->delete();
        return redirect()->route('backoffice.admin.carousel-slides.index')->with('success', 'Slide removido com sucesso!');
    }
}
