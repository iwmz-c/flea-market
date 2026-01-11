@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="profile">
    @php
    $user = auth()->user();
    $profile = $user->profile;

    
    $profileImage = $profile?->profile_image_path
        ? asset('storage/' . $profile->profile_image_path)
        : '';
    @endphp

    <div class="mypage-profile">
        <div class="mypage-profile__image" style="{{ $profileImage ? "background-image: url('$profileImage')" : '' }}"></div>
        <div class="mypage-profile__name">
            {{ $profile->profile_name ?? $user->name }}
        </div>
        <a href="{{ route('profile.edit') }}" class="mypage-profile__edit-button">
            プロフィールを編集
        </a>
    </div>
</div>
<livewire:my-item-list />
@endsection