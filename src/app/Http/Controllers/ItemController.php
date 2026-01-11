<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        $items = Item::with('purchase')->get();
        
        return view('index');
    }

    public function sell() {
        $categories = Category::all();
        $conditions = Condition::all();
        $item = null;
        return view('sell', compact('categories', 'conditions', 'item'));
    }

    public function store(ExhibitionRequest $request) {
        $validated = $request->validated();

        $path = $request->file('item_image')->store('items', 'public');

        $data = $request->safe()->only([
            'name','brand_name','price','condition_id','detail',
        ]);

        $item = Item::create(array_merge($data, [
            'user_id' => auth()->id(),
            'item_image_path' => $path,
        ]));

        $item->categories()->sync($validated['category_ids']);

        return redirect()->route('home')->with('success', '商品を出品しました！');
    }

    public function show(Item $item) {
        $item->load(['categories', 'condition'])
            ->loadCount(['favorites', 'comments']);
        
        return view('show', compact('item'));
    }
}
