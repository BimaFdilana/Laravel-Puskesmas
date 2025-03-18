<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.web.beranda-page');
})->name('beranda');

Route::middleware(['auth'])->group(function() {
    Route::get('home', function(){
        return view('pages.apps.dashboard');
    })->name('home');
});