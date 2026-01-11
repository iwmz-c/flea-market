@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css')}}">
@endsection

@section('content')
<div class="sell-form">
    <h2 class="sell-form__heading">商品の出品</h2>
    <div class="sell-form__inner">
        @if ($errors->any())
            <div style="color:red; padding:10px;">
                <strong>バリデーションエラー：</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="sell-form__form" action="/sell" method="post" enctype="multipart/form-data">
            @csrf

            @php
            $itemImage =  $item?->item_image_path
                ? asset('storage/' . $item->item_image_path)
                : '';
            @endphp

            <label class="sell-form__label" for="itemImage">商品画像</label>
            <div class="sell-form__group--image">
                
                <div class="sell-form__preview" id="itemPreview" style="background-image: url('{{ $itemImage }}')">
                    <label class="sell-form__file-label" for="itemImage">画像を選択する</label>
                </div>
                <input class="sell-form__file-input" id="itemImage" type="file" name="item_image" accept="image/jpeg, image/png">
                <p class="sell-form__error-message">
                    @error('item_image')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="sell-form__group">
                <h3 class="sell-form__title">商品の詳細</h3>
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label" for="category_ids">カテゴリー</label>
                <div class="category-list">
                    @foreach ($categories as $category)
                        <div class="category-item">
                            <input
                                class="sell-form__checkbox"
                                type="checkbox"
                                id="category_{{ $category->id }}"
                                name="category_ids[]"
                                value="{{ $category->id }}"
                                {{ in_array($category->id, old('category_ids', $item?->categories->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}
                            >
                            <label for="category_{{ $category->id }}" class="category-label">
                            {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <p class="sell-form__error-message">
                    @error('category_ids')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label" for="condition_id">商品の状態</label>
                <div class="select-wrapper">
                    <select class="sell-form__select" name="condition_id" id="condition-id">
                        <option value="" disabled selected hidden>選択してください</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition->id }}" {{ old('condition_id')==$condition->id ? 'selected' : '' }}>{{ $condition->content }}</option>
                        @endforeach
                    </select>
                </div>
                <p class="sell-form__error-message">
                    @error('condition_id')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="sell-form__group">
                <h3 class="sell-form__title">商品名と説明</h3>
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label" for="name">商品名</label>
                <input class="sell-form__input" type="text" name="name" value="{{ old('name', $item?->name) }}">
                <p class="sell-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label" for="brand_name">ブランド名</label>
                <input class="sell-form__input" type="text" name="brand_name" value="{{ old('brand_name', $item?->brand_name) }}">
                <p class="sell-form__error-message">
                    @error('brand_name')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label" for="detail">商品の説明</label>
                <textarea class="sell-form__input" name="detail" cols="30" rows="3">{{ old('detail', $item?->detail) }}</textarea>
                <p class="sell-form__error-message">
                    @error('detail')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label" for="price">販売価格</label>
                <div class="price-input-wrap">
                    <input class="sell-form__input" type="text" name="price" value="{{ old('price', $item?->price) }}">
                </div>
                <p class="sell-form__error-message">
                    @error('price')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="sell-form__button" type="submit" value="出品する">
        </form>

        <script>
        document.getElementById('itemImage').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('itemPreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.style.backgroundImage = `url(${e.target.result})`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.backgroundImage = 'none';
            }
        });
        </script>

    </div>
</div>
@endsection
