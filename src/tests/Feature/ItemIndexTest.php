<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use App\Models\Condition;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_items_are_displayed()
    {
        $user = User::factory()->create();
        $condition = Condition::factory()->create();
        Item::factory()->create([
            'user_id' => $user->id,
            'name' => '商品A',
            'price' => 1000,
            'condition_id' => $condition->id,
            'item_image_path' => 'test.jpg',
            'detail' => 'テスト商品です',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('商品A');
    }

    public function test_sold_item_is_marked_as_sold()
    {
        $seller = User::factory()->create();
        $buyer  = User::factory()->create();

        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
            'name' => '売却済み商品',
            'price' => 1000,
            'condition_id' => $condition->id,
            'item_image_path' => 'test.jpg',
            'detail' => 'テスト商品です',
        ]);

        Purchase::factory()->create([
            'user_id' => $buyer->id,
            'item_id' => $item->id,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('売却済み商品');

        $response->assertSee('SOLD');
    }

    public function test_own_items_are_not_displayed()
    {
        $me = User::factory()->create();
        $other = User::factory()->create();

        $condition = \App\Models\Condition::factory()->create();

        Item::factory()->create([
            'user_id' => $me->id,
            'name' => '自分の商品',
            'price' => 1000,
            'condition_id' => $condition->id,
            'item_image_path' => 'my.jpg',
            'detail' => '自分の出品',
        ]);

        Item::factory()->create([
            'user_id' => $other->id,
            'name' => '他人の商品',
            'price' => 2000,
            'condition_id' => $condition->id,
            'item_image_path' => 'other.jpg',
            'detail' => '他人の出品',
        ]);

        $response = $this->actingAs($me)->get('/');

        $response->assertStatus(200);

        $response->assertDontSee('自分の商品');

        $response->assertSee('他人の商品');
    }
}
