<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories'
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Kategori ini sudah ada'
        ]);

        Category::create($request->only('name'));
        return redirect()->route('admin.manga.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy(Category $category)
    {
        try {
            if ($category->mangas()->count() > 0) {
                return redirect()->route('admin.manga.index')->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh manga');
            }

            // Hapus relasi manga_category terlebih dahulu jika ada
            $category->mangas()->detach();
            
            // Hapus kategori secara permanen
            $category->forceDelete();

            return redirect()->route('admin.manga.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.manga.index')->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
