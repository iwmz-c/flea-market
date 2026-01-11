<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;


class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favorite::create([
            'user_id' => 1,  // 自分
            'item_id' => 2, // 他人の商品
        ]);
    }
}
