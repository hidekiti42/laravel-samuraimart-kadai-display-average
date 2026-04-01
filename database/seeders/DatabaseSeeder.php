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

    // 自分で作った他のSeederもここに追加しておくと楽です
    $this->call(MajorCategoriesTableSeeder::class);
    $this->call(CategoriesTableSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
