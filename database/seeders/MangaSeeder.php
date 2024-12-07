<?php

namespace Database\Seeders;

use App\Models\Manga;
use App\Models\Category;
use Illuminate\Database\Seeder;

class MangaSeeder extends Seeder
{
    public function run(): void
    {
        // Buat kategori terlebih dahulu
        $categories = [
            ['name' => 'Action'],
            ['name' => 'Adventure'],
            ['name' => 'Comedy'],
            ['name' => 'Drama'],
            ['name' => 'Fantasy'],
            ['name' => 'Romance'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Data manga
        $mangas = [
            [
                'title' => 'One Piece',
                'author' => 'Eiichiro Oda',
                'price' => 99000,
                'stock' => 50,
                'description' => 'Petualangan Monkey D. Luffy dalam mencari One Piece dan menjadi Raja Bajak Laut.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/9/90/One_Piece%2C_Volume_61_Cover_%28Japanese%29.jpg?20180916000848',
                'categories' => [1, 2, 3] // Action, Adventure, Comedy
            ],
            [
                'title' => 'Naruto',
                'author' => 'Masashi Kishimoto',
                'price' => 95000,
                'stock' => 45,
                'description' => 'Perjalanan Naruto Uzumaki untuk menjadi Hokage terhebat di desanya.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/9/94/NarutoCoverTankobon1.jpg?20180914170422',
                'categories' => [1, 2, 5] // Action, Adventure, Fantasy
            ],
            [
                'title' => 'Demon Slayer',
                'author' => 'Koyoharu Gotouge',
                'price' => 85000,
                'stock' => 60,
                'description' => 'Kisah Tanjiro Kamado dalam membasmi iblis dan menyelamatkan adiknya.',
                'cover_url' => 'https://m.media-amazon.com/images/I/81ZNkhqRvVL._AC_UF1000,1000_QL80_.jpg',
                'categories' => [1, 4, 5] // Action, Drama, Fantasy
            ],
            [
                'title' => 'Jujutsu Kaisen',
                'author' => 'Gege Akutami',
                'price' => 89000,
                'stock' => 40,
                'description' => 'Petualangan Yuji Itadori dalam dunia jujutsu dan kutukan.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/4/46/Jujutsu_kaisen.jpg',
                'categories' => [1, 5] // Action, Fantasy
            ],
            [
                'title' => 'My Hero Academia',
                'author' => 'Kohei Horikoshi',
                'price' => 79000,
                'stock' => 55,
                'description' => 'Cerita tentang Izuku Midoriya dalam perjalanannya menjadi pahlawan terhebat.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/5/5a/Boku_no_Hero_Academia_Volume_1.png',
                'categories' => [1, 3, 4] // Action, Comedy, Drama
            ]
        ];

        foreach ($mangas as $manga) {
            $categories = $manga['categories'];
            unset($manga['categories']);
            
            $newManga = Manga::create($manga);
            $newManga->categories()->attach($categories);
        }
    }
} 