<?php

namespace App\Http\Controllers;

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
        return back()->with('category_success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy(Category $category)
    {
        if ($category->mangas()->count() > 0) {
            return back()->with('category_error', 'Kategori tidak dapat dihapus karena masih digunakan oleh manga');
        }

        $category->delete();
        return back()->with('category_success', 'Kategori berhasil dihapus!');
    }
}
