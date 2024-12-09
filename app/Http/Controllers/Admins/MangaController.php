<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Manga;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::with('categories')->get();
        $categories = Category::all();
        return view('admin.manga.index', compact('mangas', 'categories'));
    }

    public function createForm()
    {
        $categories = Category::all();
        return view('admin.manga.create', compact('categories'));
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'required|string',
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'categories' => 'required|array|min:1',
                'categories.*' => 'exists:categories,category_id'
            ]);

            // Bersihkan format angka
            $price = (int) str_replace(['.', ','], '', $request->price);
            $stock = (int) str_replace(['.', ','], '', $request->stock);

            // Upload cover
            if ($request->hasFile('cover')) {
                $coverName = $request->title . '-' . time() . '.' . $request->cover->extension();
                $coverName = str_replace(['#', '/', '\\', ' '], '-', strtolower($coverName));
                $request->cover->move(public_path('images/covers'), $coverName);
                $coverPath = 'images/covers/' . $coverName;
            }

            // Buat record manga
            $manga = Manga::create([
                'title' => $request->title,
                'author' => $request->author,
                'price' => $price,
                'stock' => $stock,
                'description' => $request->description,
                'cover_url' => $coverPath ?? null
            ]);

            $manga->categories()->attach($request->categories);

            return redirect()->route('admin.manga.index')->with('success', 'Manga berhasil ditambahkan!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function updateForm(Manga $manga)
    {
        $categories = Category::all();
        $manga->load('categories');
        return view('admin.manga.update', compact('manga', 'categories'));
    }

    public function update(Request $request, Manga $manga)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'required|string',
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'categories' => 'required|array|min:1',
                'categories.*' => 'exists:categories,category_id'
            ]);

            // Bersihkan format angka
            $price = (int) str_replace(['.', ','], '', $request->price);
            $stock = (int) str_replace(['.', ','], '', $request->stock);

            // Upload cover baru jika ada
            if ($request->hasFile('cover')) {
                // Hapus file lama jika bukan URL eksternal
                if ($manga->cover_url && !str_starts_with($manga->cover_url, 'http')) {
                    $oldCoverPath = public_path($manga->cover_url);
                    if (file_exists($oldCoverPath)) {
                        unlink($oldCoverPath);
                    }
                }

                $coverName = $request->title . '-' . time() . '.' . $request->cover->extension();
                $coverName = str_replace(['#', '/', '\\', ' '], '-', strtolower($coverName));
                $request->cover->move(public_path('images/covers'), $coverName);
                $coverPath = 'images/covers/' . $coverName;
            }

            // Update manga
            $manga->update([
                'title' => $request->title,
                'author' => $request->author,
                'price' => $price,
                'stock' => $stock,
                'description' => $request->description,
                'cover_url' => $coverPath ?? $manga->cover_url
            ]);

            // Sync categories
            $manga->categories()->sync($request->categories);

            return redirect()->route('admin.manga.index')->with('success', 'Manga berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Manga $manga)
    {
        try {
            // Hapus file cover jika bukan URL eksternal
            if ($manga->cover_url && !str_starts_with($manga->cover_url, 'http')) {
                $coverPath = public_path($manga->cover_url);
                if (file_exists($coverPath)) {
                    unlink($coverPath);
                }
            }

            $manga->delete(); // Soft delete manga
            return redirect()->route('admin.manga.index')->with('success', 'Manga berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
