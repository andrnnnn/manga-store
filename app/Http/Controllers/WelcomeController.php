<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        }
        
        $featuredMangas = Manga::inRandomOrder()->limit(6)->get();
        return view('welcome', compact('featuredMangas'));
    }
}
