@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
<livewire:item-list />
@endsection