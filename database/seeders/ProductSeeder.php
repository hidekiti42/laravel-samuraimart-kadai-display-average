<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 既存のFakerデータを消す
        Product::truncate();

        // 1つ目の商品を登録
        Product::create([
            'name' => 'リーダーシップの探究',
            'description' => 'ビジネス本です。',
            'price' => 2500,
            'category_id' => 1, // ビジネスのID
            // 画像はあらかじめ public/img に置いておく必要があります
            'image' => 'book01.jpg',
            'recommend_flag' => true, // おすすめにする
        ]);

        // 同様に2つ目、3つ目を Product::create([...]) で追加する
    }
}
