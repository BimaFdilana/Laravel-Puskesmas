<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Blank;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeluargaBerencanaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\AncRecordController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\ImunisasiBayiController;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// website
Route::get('about', [LandingPageController::class, 'tentangKami'])->name('about');
Route::get('contact', [LandingPageController::class, 'kontak'])->name('contact');

Route::post('contact', [PublicContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [BerandaController::class, 'index'])->name('home');

    Route::get('setting-akun', [AuthController::class, 'settingAccount'])->name('admin.account.setting');
    Route::put('setting-akun/{id}', [AuthController::class, 'updateUserData'])->name('admin.account.update');

    // dashboard
    Route::get('dashboard', [LandingPageController::class, 'landingPage'])->name('dashboard');

    // CRUD admin
    Route::get('/beranda', [BerandaController::class, 'edit'])->name('admin.beranda.edit');
    Route::put('/beranda', [BerandaController::class, 'update'])->name('admin.beranda.update');

    Route::get('admin/contact', [ContactController::class, 'edit'])->name('admin.contact.edit');
    Route::put('admin/contact', [ContactController::class, 'update'])->name('admin.contact.update');

    Route::get('admin/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::delete('admin/messages/{message}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');

    Route::resource('services', ServiceController::class);

    // user
    Route::get('users', [AuthController::class, 'showUserData'])->name('usersData');
    Route::get('users/{id}/edit', [AuthController::class, 'editUserData'])->name('editUserData');
    Route::put('users/{id}', [AuthController::class, 'updateUserData'])->name('updateUserData');
    Route::delete('users/{id}', [AuthController::class, 'destroy'])->name('deleteUser');
    // register pustu
    Route::get('/registerPustu', [AuthController::class, 'showRegisterForm'])->name('registerForm');
    Route::post('/registerPustu', [AuthController::class, 'registerPustu'])->name('registerPustu');

    // keluarga berencana
    Route::get('keluarga-berencana', [KeluargaBerencanaController::class, 'index'])->name('keluargaBerencana');
    Route::delete('keluarga-berencana/{id}', [KeluargaBerencanaController::class, 'destroy'])->name('deleteKeluargaBerencana');

    // imunusasi
    Route::get('imunisasi-bayi/export', [ImunisasiBayiController::class, 'export'])->name('imunisasi-bayi.export');
    Route::resource('imunisasi-bayi', ImunisasiBayiController::class);

    // penyakit
    Route::get('penyakit', [PenyakitController::class, 'index'])->name('penyakit');
    Route::delete('penyakit/{id}', [PenyakitController::class, 'destroy'])->name('deletePenyakit');

    // ANC
    Route::resource('anc', AncRecordController::class)->names('anc');
    Route::get('anc/{ancRecord}/export-word', [AncRecordController::class, 'exportWord'])->name('anc.export-word');

    Route::get('blank', [Blank::class, 'index'])->name('blank');
});