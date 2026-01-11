<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run()
    {
        $seller = User::where('email', 'seller@example.com')->first();

        $items = [
            [
                'name' => '腕時計',
                'brand_name' => 'Rolax',
                'price' => 15000,
                'detail' => 'スタイリッシュなデザインのメンズ腕時計',
                'condition_id' => 1,
            ],
            [
                'name' => 'HDD',
                'brand_name' => '西芝',
                'price' => 5000,
                'detail' => '高速で信頼性の高いハードディスク',
                'condition_id' => 2,
            ],
            [
                'name' => '玉ねぎ3束',
                'brand_name' => null,
                'price' => 300,
                'detail' => '新鮮な玉ねぎ3束のセット',
                'condition_id' => 3,
            ],
            [
                'name' => '革靴',
                'brand_name' => null,
                'price' => 4000,
                'detail' => 'クラシックなデザインの革靴',
                'condition_id' => 4,
            ],
            [
                'name' => 'ノートPC',
                'brand_name' => null,
                'price' => 45000,
                'detail' => '高性能なノートパソコン',
                'condition_id' => 1,
            ],
            [
                'name' => 'マイク',
                'brand_name' => null,
                'price' => 8000,
                'detail' => '高音質のレコーディング用マイク',
                'condition_id' => 2,
            ],
            [
                'name' => 'ショルダーバッグ',
                'brand_name' => null,
                'price' => 3500,
                'detail' => 'おしゃれなショルダーバッグ',
                'condition_id' => 3,
            ],
            [
                'name' => 'タンブラー',
                'brand_name' => null,
                'price' => 500,
                'detail' => '使いやすいタンブラー',
                'condition_id' => 4,
            ],
            [
                'name' => 'コーヒーミル',
                'brand_name' => 'Starbacks',
                'price' => 4000,
                'detail' => '手動のコーヒーミル',
                'condition_id' => 1,
            ],
            [
                'name' => 'メイクセット',
                'brand_name' => null,
                'price' => 2500,
                'detail' => '便利なメイクアップセット',
                'condition_id' => 2,
            ],
        ];

        foreach ($items as $item) {
            Item::create([
                'user_id' => $seller->id,
                'name' => $item['name'],
                'brand_name' => $item['brand_name'],
                'price' => $item['price'],
                'detail' => $item['detail'],
                'condition_id' => $item['condition_id'],
                'item_image_path' => 'items/dummy.jpg',
            ]);
        }
    }
}
