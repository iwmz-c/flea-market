<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller = User::create([
            'name' => '出品者ユーザー',
            'email' => 'seller@example.com',
            'password' => Hash::make('password'),
        ]);

        Profile::create([
            'user_id' => $seller->id,
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区1-2-3',
            'building' => 'テストビル101',
            'profile_name' => '出品者 太郎',
        ]);

        $buyer = User::create([
            'name' => '購入者ユーザー',
            'email' => 'buyer@example.com',
            'password' => Hash::make('password'),
        ]);

        Profile::create([
            'user_id' => $buyer->id,
            'postal_code' => '987-6543',
            'address' => '大阪府大阪市1-2-3',
            'building' => 'サンプルマンション202',
            'profile_name' => '購入者 花子',
        ]);
    }
}
