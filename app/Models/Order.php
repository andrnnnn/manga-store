<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'invoice_number'
    ];

    protected $attributes = [
        'status' => 'pending',
        'total_price' => 0
    ];

    protected $casts = [
        'total_price' => 'decimal:2'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    // Accessor untuk format status
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Menunggu'
        };
    }

    // Accessor untuk format status badge color
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'yellow'
        };
    }

    // Scope untuk filter berdasarkan status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}
