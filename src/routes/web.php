<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ItemController::class, 'index'])->name('home');
Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile', [ProfileController::class, 'create'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class,'update'])->name('mypage.profile');
    Route::get('/sell', [ItemController::class,'sell'])->name('sell');
    Route::post('/sell', [ItemController::class, 'store'])->name('sell.store');
    Route::get('/purchase/{item}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])
    ->name('purchase.store');
    Route::get('/purchase/address/{item}', [AddressController::class, 'edit'])->name('purchase.address.edit');
    Route::post('/purchase/address/{item}', [AddressController::class, 'update'])->name('purchase.address.update');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});