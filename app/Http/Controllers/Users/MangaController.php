<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Manga;
use App\Models\Category;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::with('categories')
            ->where('stock', '>', 0)
            ->whereNull('deleted_at')
            ->get();
            
        $categories = Category::whereNull('deleted_at')->get();
            
        return view('user.dashboard', compact('mangas', 'categories'));
    }

    public function show(Manga $manga)
    {
        if ($manga->deleted_at !== null) {
            abort(404);
        }

        $manga->load('categories');
        return view('user.manga-detail', compact('manga'));
    }
}
