<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\User;
use App\Models\Manga;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user regular
        $users = User::where('role', '!=', 'admin')->get();
        $mangas = Manga::all();

        // Untuk setiap user, tambahkan 1-3 item ke cart mereka
        foreach ($users as $user) {
            $numberOfItems = rand(1, 3);
            $selectedMangas = $mangas->random($numberOfItems);

            foreach ($selectedMangas as $manga) {
                CartItem::create([
                    'user_id' => $user->user_id,
                    'manga_id' => $manga->manga_id,
                    'quantity' => rand(1, 3)
                ]);
            }
        }
    }
} 