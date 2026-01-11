@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css')}}">
@endsection

@section('content')
<div class="profile-form">
    <h2 class="profile-form__heading">プロフィール設定</h2>
    <div class="profile-form__inner">
        <form class="profile-form__form" action="/mypage/profile" method="post" enctype="multipart/form-data">
            @csrf

            @php
            $profileImage =  $profile?->profile_image_path
                ? asset('storage/' . $profile->profile_image_path)
                : '';
            @endphp

            <div class="profile-form__group--image">
                <div class="profile-form__preview" id="profilePreview" style="background-image: url('{{ $profileImage }}')"></div>
                <label class="profile-form__file-label" for="profileImage">画像を選択する</label>
                <input class="profile-form__file-input" id="profileImage" type="file" name="profile_image" accept="image/jpeg, image/png">
                <p class="profile-form__error-message">
                    @error('profile_image')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="profile-form__group">
                <label class="profile-form__label" for="profile_name">ユーザー名</label>
                <input class="profile-form__input" type="text" name="profile_name" value="{{ old('profile_name', $profile->profile_name) }}">
                <p class="profile-form__error-message">
                    @error('profile_name')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="profile-form__group">
                <label class="profile-form__label" for="postal_code">郵便番号</label>
                <input class="profile-form__input" type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code) }}">
                <p class="profile-form__error-message">
                    @error('postal_code')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="profile-form__group">
                <label class="profile-form__label" for="address">住所</label>
                <input class="profile-form__input" type="name" name="address" value="{{ old('address', $profile->address) }}">
                <p class="profile-form__error-message">
                    @error('address')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="profile-form__group">
                <label class="profile-form__label" for="building">建物名</label>
                <input class="profile-form__input" type="name" name="building" value="{{ old('building', $profile->building) }}">
                <p class="profile-form__error-message">
                    @error('building')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="profile-form__button" type="submit" value="更新する">
        </form>

        <script>
        document.getElementById('profileImage').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('profilePreview');
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