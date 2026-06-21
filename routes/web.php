<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});



Route::livewire('/daily-input', 'pages::daily-input')->name('daily-input');

require __DIR__.'/settings.php';
