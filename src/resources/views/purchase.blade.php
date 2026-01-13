@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@endsection

@section('content')
<div class="purchase-page">
    <form class="purchase-form" action="{{ route('purchase.checkout', $item) }}" method="POST">
    @csrf
        <div class="purchase-content">
            <div class="purchase-left">
                <div class="item-data">
                    <div class="item-picture">
                        <img src="{{ asset('storage/' . $item->item_image_path) }}" alt="{{ $item->name }}" class="item-image">
                    </div>
                    <div class="item-information">
                        <p class="item-information__name">{{ $item->name }}</p>
                        <p class="item-information__price">
                            <span class="item-information__price-mark">￥</span>
                            <span class="item-information__price-price">{{ number_format($item->price) }}</span>
                        </p>
                    </div>
                </div>

                <div class="purchase-section">
                    <p class="payment_method__title">支払い方法</p>
                    <div class="select-wrapper">
                        <select class="payment_method__select" name="payment_method" id="payment-method-select">
                            <option value="" disabled selected hidden>選択してください</option>
                            <option value="convenience">コンビニ払い</option>
                            <option value="card">カード払い</option>
                        </select>
                        @error('payment_method')
                            <p class="purchase-form__error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="purchase-section">
                    <div class="shipping-address">
                        <div class="shipping-address__header">
                            <p class="shipping-address__title">配送先</p>
                            <a class="shipping-address__link" href="{{ route('purchase.address.edit', $item) }}">変更する</a>
                        </div>
                        @if($address['postal_code'])
                            <p class="shipping-address__postal_code">〒{{ $address['postal_code'] }}</p>
                            <p class="shipping-address__address">{{ $address['address'] }}</p>
                            @if(!empty($address['building']))
                            <p class="shipping-address__address">{{ $address['building'] }}</p>
                            @endif
                        @else
                            <p class="purchase-form__error-message">配送先が登録されていません</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="purchase-right">
                <input type="hidden" name="postal_code" value="{{ $address['postal_code'] }}">
                <input type="hidden" name="address" value="{{ $address['address'] }}">
                <input type="hidden" name="building" value="{{ $address['building'] }}">

                <table>
                    <tr>
                        <th>商品代金</th>
                        <td>￥{{ number_format($item->price) }}</td>
                    </tr>
                    <tr>
                        <th>支払い方法</th>
                        <td id="payment-method-display">未選択</td>
                    </tr>
                </table>

                <button type="submit">購入する</button>
                
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('payment-method-select');
    const display = document.getElementById('payment-method-display');

    select.addEventListener('change', () => {
        if (select.value === 'convenience') {
            display.textContent = 'コンビニ払い';
        } else if (select.value === 'card') {
            display.textContent = 'カード払い';
        }
    });
});
</script>

@endsection