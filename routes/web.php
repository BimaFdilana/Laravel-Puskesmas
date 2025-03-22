<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Blank;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.web.beranda-page');
})->name('beranda');


Route::get('about', [LandingPageController::class, 'tentangKami'])->name('about');
Route::get('contact', [LandingPageController::class, 'kontak'])->name('contact');

Route::middleware(['auth'])->group(function() {
    Route::get('home', function(){
        return view('pages.web.beranda-page', ['type_menu' => '']);
    })->name('home');

    Route::get('dashboard', [LandingPageController::class, 'landingPage'])->name('dashboard');

    // user
    Route::get('users', [AuthController::class, 'showUserData'])->name('usersData');
    Route::get('users/edit', [AuthController::class, 'editUserData'])->name('editUserData');
    Route::delete('users/{id}', [AuthController::class, 'destroy'])->name('deleteUser');

    //register pustu

    Route::get('/registerPustu', [AuthController::class, 'showRegisterForm'])->name('registerForm');
    Route::post('/registerPustu', [AuthController::class, 'registerPustu'])->name('registerPustu');


    Route::get('blank', [Blank::class, 'index'])->name('blank');
});