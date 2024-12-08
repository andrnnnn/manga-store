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
            ['name' => 'Horror'],
            ['name' => 'Mystery'],
            ['name' => 'Psychological'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Slice of Life'],
            ['name' => 'Sports'],
            ['name' => 'Supernatural'],
            ['name' => 'Thriller'],
            ['name' => 'School Life'],
            ['name' => 'Martial Arts'],
            ['name' => 'Mecha'],
            ['name' => 'Historical'],
            ['name' => 'Isekai'],
            ['name' => 'Shounen'],
            ['name' => 'Shoujo'],
            ['name' => 'Seinen'],
            ['name' => 'Josei'],
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
                'description' => 'Petualangan Monkey D. Luffy dalam mencari One Piece dan menjadi Raja Bajak Laut. Luffy, yang memiliki kekuatan buah iblis Gomu Gomu, berlayar bersama kru bajak lautnya, Topi Jerami, untuk menemukan harta karun legendaris One Piece dan mengklaim gelar Raja Bajak Laut.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/9/90/One_Piece%2C_Volume_61_Cover_%28Japanese%29.jpg?20180916000848',
                'categories' => [1, 2, 3] // Action, Adventure, Comedy
            ],
            [
                'title' => 'Naruto',
                'author' => 'Masashi Kishimoto',
                'price' => 95000,
                'stock' => 45,
                'description' => 'Perjalanan Naruto Uzumaki untuk menjadi Hokage terhebat di desanya. Naruto, seorang ninja muda dengan semangat pantang menyerah, berusaha mendapatkan pengakuan dari desanya dan mencapai impiannya menjadi Hokage, pemimpin desa Konoha.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/9/94/NarutoCoverTankobon1.jpg?20180914170422',
                'categories' => [1, 2, 5] // Action, Adventure, Fantasy
            ],
            [
                'title' => 'Demon Slayer',
                'author' => 'Koyoharu Gotouge',
                'price' => 85000,
                'stock' => 60,
                'description' => 'Kisah Tanjiro Kamado dalam membasmi iblis dan menyelamatkan adiknya. Setelah keluarganya dibantai oleh iblis, Tanjiro bertekad menjadi pembasmi iblis untuk menyelamatkan adiknya, Nezuko, yang berubah menjadi iblis namun masih memiliki sisi kemanusiaan.',
                'cover_url' => 'https://m.media-amazon.com/images/I/81ZNkhqRvVL._AC_UF1000,1000_QL80_.jpg',
                'categories' => [1, 4, 5] // Action, Drama, Fantasy
            ],
            [
                'title' => 'Jujutsu Kaisen',
                'author' => 'Gege Akutami',
                'price' => 89000,
                'stock' => 40,
                'description' => 'Petualangan Yuji Itadori dalam dunia jujutsu dan kutukan. Yuji, seorang siswa SMA yang memiliki kekuatan fisik luar biasa, terlibat dalam dunia jujutsu setelah menelan jari kutukan legendaris, Ryomen Sukuna, dan bergabung dengan sekolah jujutsu untuk melawan kutukan jahat.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/4/46/Jujutsu_kaisen.jpg',
                'categories' => [1, 5] // Action, Fantasy
            ],
            [
                'title' => 'My Hero Academia',
                'author' => 'Kohei Horikoshi',
                'price' => 79000,
                'stock' => 55,
                'description' => 'Cerita tentang Izuku Midoriya dalam perjalanannya menjadi pahlawan terhebat. Izuku, yang awalnya tidak memiliki kekuatan super (Quirk), mendapatkan kekuatan dari pahlawan legendaris All Might dan berusaha menjadi pahlawan profesional di sekolah pahlawan U.A. High School.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/5/5a/Boku_no_Hero_Academia_Volume_1.png',
                'categories' => [1, 3, 4] // Action, Comedy, Drama
            ],
            [
                'title' => 'Attack on Titan',
                'author' => 'Hajime Isayama',
                'price' => 100000,
                'stock' => 30,
                'description' => 'Pertarungan manusia melawan raksasa yang mengancam umat manusia. Eren Yeager dan teman-temannya bergabung dengan militer untuk melawan para Titan, raksasa pemakan manusia yang telah menghancurkan tembok perlindungan umat manusia.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/d/d6/Shingeki_no_Kyojin_manga_volume_1.jpg/220px-Shingeki_no_Kyojin_manga_volume_1.jpg',
                'categories' => [1, 4, 14] // Action, Drama, Thriller
            ],
            [
                'title' => 'Death Note',
                'author' => 'Tsugumi Ohba',
                'price' => 85000,
                'stock' => 40,
                'description' => 'Kisah Light Yagami yang menemukan buku catatan kematian. Light, seorang siswa jenius, menemukan Death Note, sebuah buku yang dapat membunuh siapa saja yang namanya ditulis di dalamnya. Ia memutuskan untuk menggunakan buku tersebut untuk membersihkan dunia dari kejahatan, namun tindakannya menarik perhatian detektif legendaris, L.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/id/6/6f/Death_Note_Vol_1.jpg',
                'categories' => [9, 8, 14] // Psychological, Mystery, Thriller
            ],
            [
                'title' => 'Dragon Ball',
                'author' => 'Akira Toriyama',
                'price' => 90000,
                'stock' => 50,
                'description' => 'Petualangan Goku dalam mencari bola naga dan melawan musuh kuat. Goku, seorang pejuang Saiyan, berpetualang untuk mengumpulkan tujuh bola naga yang dapat mengabulkan permintaan, sambil melawan berbagai musuh kuat yang mengancam kedamaian dunia.',
                'cover_url' => 'https://comicvine.gamespot.com/a/uploads/scale_small/4/40363/1185935-japanese_31.jpg',
                'categories' => [1, 2, 5] // Action, Adventure, Fantasy
            ],
            [
                'title' => 'Bleach',
                'author' => 'Tite Kubo',
                'price' => 87000,
                'stock' => 35,
                'description' => 'Kisah Ichigo Kurosaki yang menjadi shinigami dan melawan hollow. Ichigo, seorang remaja yang dapat melihat roh, mendapatkan kekuatan shinigami dan bertugas melindungi manusia dari roh jahat yang disebut hollow, sambil mengungkap misteri di balik kekuatannya.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/3/3f/Bleach_%28manga%29_1.png/220px-Bleach_%28manga%29_1.png',
                'categories' => [1, 5, 13] // Action, Fantasy, Supernatural
            ],
            [
                'title' => 'Tokyo Ghoul',
                'author' => 'Sui Ishida',
                'price' => 92000,
                'stock' => 40,
                'description' => 'Kisah Kaneki Ken yang berubah menjadi ghoul dan berjuang untuk bertahan hidup. Kaneki, seorang mahasiswa biasa, berubah menjadi setengah ghoul setelah mengalami serangan dari ghoul. Ia harus beradaptasi dengan kehidupan barunya sambil berusaha mempertahankan kemanusiaannya.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e5/Tokyo_Ghoul_volume_1_cover.jpg/220px-Tokyo_Ghoul_volume_1_cover.jpg',
                'categories' => [7, 9, 14] // Horror, Psychological, Thriller
            ],
            [
                'title' => 'Sword Art Online',
                'author' => 'Reki Kawahara',
                'price' => 88000,
                'stock' => 45,
                'description' => 'Petualangan Kirito dalam dunia game virtual yang mematikan. Kirito, seorang pemain game yang terjebak dalam game virtual reality Sword Art Online, harus bertarung untuk bertahan hidup dan keluar dari game tersebut, di mana kematian dalam game berarti kematian di dunia nyata.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/3/3e/Sword_Art_Online_light_novel_volume_1_cover.jpg/220px-Sword_Art_Online_light_novel_volume_1_cover.jpg',
                'categories' => [2, 5, 10] // Adventure, Fantasy, Sci-Fi
            ],
            [
                'title' => 'Fairy Tail',
                'author' => 'Hiro Mashima',
                'price' => 86000,
                'stock' => 50,
                'description' => 'Petualangan Natsu Dragneel dan teman-temannya dalam guild Fairy Tail. Natsu, seorang penyihir api, bersama teman-temannya di guild Fairy Tail, menjalani berbagai misi berbahaya dan menghadapi musuh kuat untuk melindungi guild mereka dan dunia sihir.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e1/FairyTail-Volume_1_Cover.jpg/220px-FairyTail-Volume_1_Cover.jpg',
                'categories' => [1, 2, 5] // Action, Adventure, Fantasy
            ],
            [
                'title' => 'Black Clover',
                'author' => 'Yūki Tabata',
                'price' => 87000,
                'stock' => 55,
                'description' => 'Kisah Asta yang bercita-cita menjadi Kaisar Sihir meskipun tidak memiliki sihir. Asta, seorang anak yatim piatu yang lahir tanpa kekuatan sihir di dunia yang penuh dengan sihir, bertekad untuk menjadi Kaisar Sihir dengan mengandalkan kekuatan fisiknya dan tekad yang kuat.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/6/69/Black_Clover%2C_volume_1.jpg/220px-Black_Clover%2C_volume_1.jpg',
                'categories' => [1, 5, 13] // Action, Fantasy, Supernatural
            ],
            [
                'title' => 'Hunter x Hunter',
                'author' => 'Yoshihiro Togashi',
                'price' => 95000,
                'stock' => 40,
                'description' => 'Petualangan Gon Freecss dalam menjadi Hunter dan mencari ayahnya. Gon, seorang anak muda yang bersemangat, bertekad menjadi Hunter, seorang petualang elit, untuk menemukan ayahnya yang juga seorang Hunter terkenal.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e8/Hunter_%C3%97_Hunter_vol._1.png/220px-Hunter_%C3%97_Hunter_vol._1.png',
                'categories' => [1, 2, 5] // Action, Adventure, Fantasy
            ],
            [
                'title' => 'Fullmetal Alchemist',
                'author' => 'Hiromu Arakawa',
                'price' => 93000,
                'stock' => 45,
                'description' => 'Kisah Edward dan Alphonse Elric dalam mencari Batu Bertuah. Edward dan Alphonse, dua saudara alkemis, berusaha mencari Batu Bertuah untuk memulihkan tubuh mereka yang rusak akibat percobaan alkimia yang gagal, sambil menghadapi berbagai konspirasi dan musuh yang kuat.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/9/9d/Fullmetal123.jpg/220px-Fullmetal123.jpg',
                'categories' => [1, 5, 18] // Action, Fantasy, Historical
            ],
            [
                'title' => 'One Punch Man',
                'author' => 'ONE',
                'price' => 89000,
                'stock' => 60,
                'description' => 'Kisah Saitama, pahlawan yang bisa mengalahkan musuh dengan satu pukulan. Saitama, seorang pahlawan yang sangat kuat, merasa bosan karena tidak ada musuh yang bisa menandingi kekuatannya. Ia terus mencari tantangan baru sambil menjalani kehidupan sehari-hari yang biasa.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/c/c3/OnePunchMan_manga_cover.png/220px-OnePunchMan_manga_cover.png',
                'categories' => [1, 3, 5] // Action, Comedy, Fantasy
            ],
            [
                'title' => 'Re:Zero',
                'author' => 'Tappei Nagatsuki',
                'price' => 88000,
                'stock' => 35,
                'description' => 'Petualangan Subaru Natsuki yang terjebak di dunia lain. Subaru, seorang remaja biasa, tiba-tiba terjebak di dunia fantasi dan menemukan bahwa ia memiliki kemampuan untuk kembali ke titik waktu tertentu setiap kali ia mati. Ia berusaha menggunakan kemampuan ini untuk melindungi teman-temannya dan mengungkap misteri di dunia baru ini.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/3/3c/Re-Zero_kara_Hajimeru_Isekai_Seikatsu_light_novel_volume_1_cover.jpg/220px-Re-Zero_kara_Hajimeru_Isekai_Seikatsu_light_novel_volume_1_cover.jpg',
                'categories' => [5, 9, 19] // Fantasy, Psychological, Isekai
            ],
            [
                'title' => 'The Promised Neverland',
                'author' => 'Kaiu Shirai',
                'price' => 91000,
                'stock' => 40,
                'description' => 'Kisah Emma dan teman-temannya yang berusaha melarikan diri dari panti asuhan. Emma, Norman, dan Ray, tiga anak jenius yang tinggal di panti asuhan, menemukan rahasia mengerikan tentang tempat mereka tinggal dan berencana melarikan diri bersama anak-anak lain untuk menyelamatkan diri dari nasib yang mengerikan.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/4/44/The_Promised_Neverland%2C_Volume_1.jpg/220px-The_Promised_Neverland%2C_Volume_1.jpg',
                'categories' => [8, 9, 14] // Mystery, Psychological, Thriller
            ],
            [
                'title' => 'Blue Exorcist',
                'author' => 'Kazue Kato',
                'price' => 87000,
                'stock' => 50,
                'description' => 'Kisah Rin Okumura yang berusaha menjadi exorcist untuk melawan ayahnya, Satan. Rin, seorang remaja yang mengetahui bahwa ia adalah anak Satan, bertekad menjadi exorcist untuk melawan ayahnya dan melindungi dunia dari ancaman iblis.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/6/62/Blue_Exorcist_vol_1.png/220px-Blue_Exorcist_vol_1.png',
                'categories' => [1, 5, 13] // Action, Fantasy, Supernatural
            ],
            [
                'title' => 'Mob Psycho 100',
                'author' => 'ONE',
                'price' => 85000,
                'stock' => 45,
                'description' => 'Kisah Shigeo Kageyama, seorang remaja dengan kekuatan psikis yang luar biasa. Shigeo, yang dikenal sebagai Mob, berusaha menjalani kehidupan normal meskipun memiliki kekuatan psikis yang sangat kuat. Ia bekerja sebagai asisten di kantor konsultasi roh sambil menghadapi berbagai ancaman supernatural.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/4/4b/Mob_Psycho_100_manga_vol_1.jpg/220px-Mob_Psycho_100_manga_vol_1.jpg',
                'categories' => [1, 3, 13] // Action, Comedy, Supernatural
            ],
            [
                'title' => 'Vinland Saga',
                'author' => 'Makoto Yukimura',
                'price' => 94000,
                'stock' => 30,
                'description' => 'Kisah Thorfinn dalam dunia Viking yang penuh dengan perang dan petualangan. Thorfinn, seorang pejuang muda, berusaha membalas dendam atas kematian ayahnya sambil terlibat dalam berbagai pertempuran dan petualangan di dunia Viking yang brutal.',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/5/51/Vinland_Saga_volume_01_cover.jpg',
                'categories' => [1, 4, 18] // Action, Drama, Historical
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
