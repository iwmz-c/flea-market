<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function edit(Item $item)
    {
        $user = auth()->user();
        $profile = $user->profile;

        if (session()->has('purchase_address')) {
            $address = session('purchase_address');
        } elseif ($profile) {
            $address = [
                'postal_code' => $profile->postal_code,
                'address'     => $profile->address,
                'building'    => $profile->building,
            ];
        } else {
            $address = [
                'postal_code' => '',
                'address'     => '',
                'building'    => '',
            ];
        }
        
        return view('purchase_address', compact('item', 'address'));
    }

    public function update(AddressRequest $request, Item $item)
    {
        session([
            'purchase_address' => [
                'postal_code' => $request->postal_code,
                'address'     => $request->address,
                'building'    => $request->building,
            ]
        ]);

        return redirect()->route('purchase.show', $item);
    }
}
