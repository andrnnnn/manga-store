<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manga extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'manga_id';

    protected $fillable = ['title', 'author', 'price', 'stock', 'cover_url', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_manga', 'manga_id', 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'manga_id');
    }
}
