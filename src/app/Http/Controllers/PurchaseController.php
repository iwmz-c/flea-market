<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest; 
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        if ($item->purchase) {
            return redirect('/')->with('error', 'この商品はすでに購入されています');
        }

        if ($item->user_id === auth()->id()) {
            return redirect('/')->with('error', '自分の商品は購入できません');
        }
        
        $profile = auth()->user()->profile;
        $sessionAddress = session('purchase_address');

        $address = [
            'postal_code' => $sessionAddress['postal_code'] ?? $profile?->postal_code,
            'address' => $sessionAddress['address'] ?? $profile?->address,
            'building' => $sessionAddress['building'] ?? $profile?->building,
        ];

        return view('purchase', compact('item', 'address'));
    }
    
    public function store(PurchaseRequest $request, Item $item)
    {
        if ($item->purchase) {
            return redirect('/')->with('error', 'この商品はすでに購入されています');
        }

        if ($item->user_id === auth()->id()) {
            return redirect('/')->with('error', '自分の商品は購入できません');
        }
        
        Purchase::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'price' => $item->price,
            'payment_method' => $request->payment_method,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        
        session()->forget('purchase_address');

        return redirect()->route('home')->with('success', '購入が完了しました');

    }
}
