<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('start_date', 'desc')->paginate(10);
        return view('backoffice.news.index', compact('news'));
    }

    public function create()
    {
        return view('backoffice.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($data);
        return redirect()->route('backoffice.admin.news.index')->with('success', 'Notícia criada com sucesso!');
    }

    public function edit(News $news)
    {
        return view('backoffice.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);
        return redirect()->route('backoffice.admin.news.index')->with('success', 'Notícia atualizada com sucesso!');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('backoffice.admin.news.index')->with('success', 'Notícia removida com sucesso!');
    }
}
