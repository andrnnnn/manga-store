<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'cart_item_id';

    protected $fillable = [
        'user_id',
        'manga_id',
        'quantity'
    ];

    protected $attributes = [
        'quantity' => 1
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Manga
    public function manga()
    {
        return $this->belongsTo(Manga::class, 'manga_id');
    }

    // Accessor untuk mendapatkan subtotal
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->manga->price;
    }

    // Scope untuk mendapatkan cart items user tertentu
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope untuk mendapatkan cart items yang aktif (tidak soft deleted)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
