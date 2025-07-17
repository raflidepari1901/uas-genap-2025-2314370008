<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Tampilkan semua artikel & kategori untuk dropdown.
     */
    public function index()
    {
        $articles = Article::with('category')->latest()->get();
        $categories = Category::all(); // untuk dropdown kategori

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Simpan artikel baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|unique:articles,slug',
            'content'      => 'required|string',
            'category_id'  => 'required|exists:categories,id',
            'is_publish'   => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_publish'] = $request->has('is_publish');

        Article::create($validated);

        return redirect()->back()->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Tampilkan satu artikel (opsional, jika kamu pakai detail page).
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Update artikel yang sudah ada.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|unique:articles,slug,' . $article->id,
            'content'      => 'required|string',
            'category_id'  => 'required|exists:categories,id',
            'is_publish'   => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_publish'] = $request->has('is_publish');

        $article->update($validated);

        return redirect()->back()->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Hapus artikel.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
    }
}
