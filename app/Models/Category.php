<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // ↓ここを追記
    protected $casts = [
        'major_category_id' => 'integer',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function major_category()
    {
        return $this->belongsTo(MajorCategory::class);
    }
}
