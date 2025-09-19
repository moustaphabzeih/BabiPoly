<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this line
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Add this line

    // --- ADD THESE LINES ---
    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id'
    ];

    // A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A product can be in many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    // ------------------------
}
