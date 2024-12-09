<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Manga;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user regular (non-admin)
        $users = User::where('role', '!=', 'admin')->get();
        $mangas = Manga::all();

        // Status yang mungkin untuk order
        $statuses = ['completed', 'pending', 'cancelled'];

        // Generate order untuk 3 bulan terakhir
        for ($i = 0; $i < 20; $i++) {
            // Random tanggal dalam 3 bulan terakhir
            $date = Carbon::now()->subDays(rand(0, 90));

            // Generate nomor invoice
            $invoiceNumber = 'INV-' . date('Ymd', strtotime($date)) . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);

            // Buat order baru
            $order = Order::create([
                'user_id' => $users->random()->user_id,
                'status' => $statuses[array_rand($statuses)],
                'invoice_number' => $invoiceNumber,
                'created_at' => $date,
                'updated_at' => $date
            ]);

            // Generate 1-5 item untuk setiap order
            $totalPrice = 0;
            $numberOfItems = rand(1, 5);
            $selectedMangas = $mangas->random($numberOfItems);

            foreach ($selectedMangas as $manga) {
                $quantity = rand(1, 3);
                $price = $manga->price;

                OrderItem::create([
                    'order_id' => $order->order_id,
                    'manga_id' => $manga->manga_id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'created_at' => $date,
                    'updated_at' => $date
                ]);

                $totalPrice += ($price * $quantity);
            }

            // Update total harga order
            $order->update([
                'total_price' => $totalPrice
            ]);
        }
    }
}
