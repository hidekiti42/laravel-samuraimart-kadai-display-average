<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 既存データを一度消去
        Product::truncate();

        // Factoryを使って190件のダミーデータを生成
        Product::factory()->count(190)->create();
    }
}
