<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari input search (jika ada)
        $search = $request->input('search');

        // Jika ada input pencarian, filter berdasarkan nama kategori
        if ($search) {
            $categories = Category::where('nama', 'like', '%' . $search . '%')->get();
        } else {
            // Jika tidak ada pencarian, ambil semua kategori
            $categories = Category::all();
        }

        // Kembalikan view dengan data kategori dan query pencarian
        return view('category.index', compact('categories', 'search'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengembalikan view untuk form pembuatan kategori
        return view('category.create');
    }

    /**
     * Menyimpan kategori baru ke dalam database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Menyimpan kategori baru
        Category::create($validated);

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit kategori yang sudah ada.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // Mengembalikan view untuk form edit kategori
        return view('category.edit', compact('category'));
    }

    /**
     * Memperbarui kategori yang sudah ada di database.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Mengupdate kategori
        $category->update($validated);

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Menghapus kategori
        $category->delete();

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
