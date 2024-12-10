<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manga extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'manga_id';

    protected $fillable = [
        'title',
        'author', 
        'description',
        'price',
        'stock',
        'cover_url'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_manga', 'manga_id', 'category_id');
    }

    public function cartItems() 
    {
        return $this->hasMany(CartItem::class, 'manga_id');
    }
}
