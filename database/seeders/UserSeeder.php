<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "英俊";
        $user->email = 'youngjoon029@gmail.com';
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make('3df36eea78f22e');
        $user->postal_code = "577-0818";
        $user->address = "大阪府東大阪市小若江2-1-15";
        $user->phone = "070-8511-1077";
        $user->save();
    }
}
