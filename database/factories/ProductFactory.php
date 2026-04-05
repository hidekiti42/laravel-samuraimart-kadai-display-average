<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        public function definition()
    {
        return [
            'name' => fake()->name(), // ランダムな氏名
            'description' => fake()->realText(50, 5), // 50文字程度の日本語テキスト
            'price' => fake()->numberBetween(100, 200000), // 100〜200,000の数値
            'category_id' => 1, // 今回は固定値で1を指定
        ];
    }
}
