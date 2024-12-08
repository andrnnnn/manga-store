<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredMangas = Manga::inRandomOrder()->limit(8)->get();
        return view('welcome', compact('featuredMangas'));
    }
}
