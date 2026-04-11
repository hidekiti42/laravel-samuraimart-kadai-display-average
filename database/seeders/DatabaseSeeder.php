<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 管理画面の初期データを呼び出す
        $this->call(\Encore\Admin\Auth\Database\AdminTablesSeeder::class);

        // ★ここを修正：$this->call([ ]) の形式でまとめて呼び出すか、一つずつ$this->callしてください
        $this->call([
            MajorCategoriesTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductSeeder::class, // これで正しく呼び出されます
        ]);
    }
}
