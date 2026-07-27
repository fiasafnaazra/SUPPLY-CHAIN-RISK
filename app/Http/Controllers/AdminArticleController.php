<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{
    // ===========================
    // Tampilkan Semua Artikel
    // ===========================
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    // ===========================
    // Form Tambah Artikel
    // ===========================
    public function create()
    {
        return view('admin.articles.create');
    }

    // ===========================
    // Simpan Artikel
    // ===========================
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|max:255',
            'country_code'   => 'required|max:100',
            'risk_level'     => 'required',
            'summary'        => 'required',
            'content'        => 'required',
            'published_at'   => 'required|date',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/articles'),
                $imageName
            );
        }

        Article::create([

            'title'         => $request->title,
            'country_code'  => $request->country_code,
            'risk_level'    => $request->risk_level,
            'summary'       => $request->summary,
            'content'       => $request->content,
            'published_at'  => $request->published_at,
            'image'         => $imageName,

        ]);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    // ===========================
    // Detail Artikel
    // ===========================
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.articles.show', compact('article'));
    }

    // ===========================
    // Form Edit
    // ===========================
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.articles.edit', compact('article'));
    }

    // ===========================
    // Update Artikel
    // ===========================
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title'          => 'required|max:255',
            'country_code'   => 'required|max:100',
            'risk_level'     => 'required',
            'summary'        => 'required',
            'content'        => 'required',
            'published_at'   => 'required|date',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = $article->image;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/articles'),
                $imageName
            );
        }

        $article->update([

            'title'         => $request->title,
            'country_code'  => $request->country_code,
            'risk_level'    => $request->risk_level,
            'summary'       => $request->summary,
            'content'       => $request->content,
            'published_at'  => $request->published_at,
            'image'         => $imageName,

        ]);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    // ===========================
    // Hapus Artikel
    // ===========================
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}