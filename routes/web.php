<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::livewire('/ware', 'pages::ware')->name('ware');
    Route::livewire('/customers', 'pages::customer.index')->name('customer.index');
    Route::livewire('/customer/{customer}/orders', 'pages::customer.order')->name('customer.order');

});

require __DIR__.'/settings.php';
