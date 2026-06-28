<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});



Route::livewire('/daily-input', 'pages::daily-input')->name('daily-input');
Route::livewire('/customers', 'pages::customer.index')->name('customer.index');
Route::livewire('/customer/{customer}/new_order', 'pages::customer.new_order')->name('customer.new_order');

require __DIR__.'/settings.php';
