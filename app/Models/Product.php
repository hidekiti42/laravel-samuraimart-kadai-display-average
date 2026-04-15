<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'recommend_flag',
        'carriage_flag',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorited_users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getAverageRatingAttribute()
{
    // レビューが存在しない場合は0を返す
    return $this->reviews()->avg('score') ?? 0;
}

public function getRoundedAverageRatingAttribute()
{
    // 0.5刻みに丸める
    return round($this->average_rating * 2) / 2;
}
}
