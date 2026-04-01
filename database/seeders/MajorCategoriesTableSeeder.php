<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MajorCategory;

class MajorCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $major_category_names = [
            '本', 'コンピュータ', 'ディスプレイ'
        ];

        foreach ($major_category_names as $major_category_name) {
            MajorCategory::create([
                'name' => $major_category_name,
                'description' => $major_category_name,
            ]);
        }
    }
}
