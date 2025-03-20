<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blank;

Route::get('/', function () {
    return view('pages.web.beranda-page');
})->name('beranda');

Route::middleware(['auth'])->group(function() {
    Route::get('home', function(){
        return view('pages.apps.petugas.dashboard', ['type_menu' => '']);
    })->name('homePetugas');

    Route::get('blank', [Blank::class, 'index'])->name('blank');
});