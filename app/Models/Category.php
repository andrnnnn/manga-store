<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'category_id';

    protected $fillable = ['name'];

    public function mangas()
    {
        return $this->belongsToMany(Manga::class, 'category_manga', 'category_id', 'manga_id');
    }
}
