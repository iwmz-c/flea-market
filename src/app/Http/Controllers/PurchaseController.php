<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest; 
use Stripe\Stripe;
use Stripe\Checkout\Session;
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

    public function checkout(PurchaseRequest $request, Item $item)
    {   
        $profile = auth()->user()->profile;
        $sessionAddress = session('purchase_address');

        $address = [
            'postal_code' => $sessionAddress['postal_code'] ?? $profile?->postal_code,
            'address' => $sessionAddress['address'] ?? $profile?->address,
            'building' => $sessionAddress['building'] ?? $profile?->building,
        ];

        session([
            'purchase_address' => $address,
            'payment_method' => $request->payment_method,
        ]);
        
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentMethod = session('payment_method');

        $paymentTypes = match ($paymentMethod) {
            'card' => ['card'],
            'convenience' => ['konbini'],
            default => ['card'],
        };

        $session = Session::create([
            'payment_method_types' => $paymentTypes,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => (int) $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', $item),
            'cancel_url' => route('purchase.cancel', $item),
        ]);

        return redirect($session->url);
    }

    public function success(Item $item)
    {
        if ($item->purchase) {
            return redirect('/')->with('error', 'この商品はすでに購入されています');
        }

        if ($item->user_id === auth()->id()) {
            return redirect('/')->with('error', '自分の商品は購入できません');
        }
        
        $user = auth()->user();
        $address = session('purchase_address');

        Purchase::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'price' => $item->price,
            'payment_method' => session('payment_method'),
            'postal_code' => $address['postal_code'],
            'address' => $address['address'],
            'building' => $address['building'],
        ]);

        $item->update(['is_sold' => true]);        
        
        session()->forget(['purchase_address', 'payment_method']);

        return redirect()->route('home')->with('success', '購入が完了しました');
    }

    public function cancel(Item $item)
    {
        return redirect()->route('purchase.show', $item);
    }


}
