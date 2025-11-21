<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index(Request $request)
    {
        $search = $request->input('search');
        // Jika ada query pencarian, cari produk berdasarkan nama atau kategori
        if ($search) {
            $products = Product::where('nama', 'like', "%$search%")
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('nama', 'like', "%$search%");
                })
                ->get();
        } else {
            $products = Product::all();
        }

        return view('product.index', compact('products', 'search'));
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        $categories = Category::all();  // Ambil semua kategori untuk dropdown
        return view('product.create', compact('categories'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'nama' => 'required|max:150',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['kategori_id', 'nama', 'deskripsi', 'harga', 'stok']);

        // Menangani upload foto produk (jika ada)
        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/products'), $filename);
            $data['foto'] = $filename;
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat!');
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    // Menyimpan perubahan produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'nama' => 'required|max:150',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['kategori_id', 'nama', 'deskripsi', 'harga', 'stok']));

        // Menangani upload foto produk (jika ada)
        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/products'), $filename);
            $product->foto = $filename;
        }

        $product->save();
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
