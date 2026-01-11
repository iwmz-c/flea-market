@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/show.css')}}">
@endsection

@section('content')
<div class="item-page">
    <div class="item-content">
        <div class="item-picture">
            <img src="{{ asset('storage/' . $item->item_image_path) }}" alt="{{ $item->name }}" class="item-image">
        </div>
        <div class="item-information">
            <div class="item-information__name">
                <p class="item-information__item-name">{{ $item->name }}</p>
                <P class="item-information__brand-name">{{ $item->brand_name }}</P>
            </div>
            <p class="item-information__price">
                <span class="item-information__price-mark">￥</span>
                <span class="item-information__price-price">{{ number_format($item->price) }}</span>
                <span class="item-information__price-tax">(税込)</span>
            </p>

            <div class="reaction-area">            
                @auth
                    @livewire('like-button', ['item' => $item])
                @else
                    <a href="{{ route('login') }}" class="reaction-item">
                        <span class="reaction-icon">♡</span>
                        <span class="reaction-count">{{ $item->favorites_count }}</span>
                    </a>
                @endauth
                @livewire('comment-count', ['item' => $item])
            </div>

            <div class="item-information__purchase">
                @if($item->purchase)
                    <p class="sold-text">SOLD OUT</p>
                @else
                    <a href="{{ route('purchase.show', $item) }}" class="purchase-button">購入手続きへ</a>
                @endif
            </div>
            <div class="item-information__detail">
                <p class="item-detail__title">商品説明</p>
                <p class="item-detail__content">{{ $item->detail }}</p>
            </div>
            <div class="item-information__item-data">
                <p class="item-data__title">商品の情報</p>
                <div class="item-data__content">
                    <p class="item-data__subtitle">カテゴリー</p>
                    <ul class="item-data__category">
                        @foreach ($item->categories as $category)
                            <li class="item-data__category-name">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="item-data__content">
                    <p class="item-data__subtitle">商品の状態</p>
                    <p class="item-data__condition">{{ $item->condition->content }}</p>
                </div>
                
                @livewire('comment-section', ['item' => $item])
                
            </div>
        </div>
    </div>
</div>
@endsection
