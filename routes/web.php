<?php

use Illuminate\Support\Facades\Route;

Route::middleware('visitor')->group(function () {
    Route::get('/', App\Http\Livewire\Public\Home\Index::class)->name('home');
});

Route::prefix('panel-admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', App\Http\Livewire\Auth\Login::class)->name('login');
    });

    Route::middleware('panel-admin')->group(function () {
        Route::get('logout', App\Http\Livewire\Auth\Logout::class)->name('logout');
    });

    Route::middleware('panel-admin','can:all')->group(function (){
        // Role Developer & Admin
        Route::get('/dashboard', App\Http\Livewire\Admin\Dashboard\Index::class)->name('dashboard');
    });

    Route::middleware('panel-admin','can:admin')->group(function (){
         // Users
         Route::get('/users', App\Http\Livewire\Admin\Users\Index::class)->name('users');
         Route::get('/users/details/{id}', App\Http\Livewire\Admin\Users\Detail::class)->name('users.detail');

         // Diskon
        Route::get('/diskon', App\Http\Livewire\Admin\Discount\Index::class)->name('diskon');

        // Laporan
        Route::get('/laporan', App\Http\Livewire\Admin\Laporan\Index::class)->name('laporan');

        //  Web Identitas
        Route::get('/web-identity/details', App\Http\Livewire\Admin\Web\Detail::class)->name('identity.detail');
    });

    Route::middleware('panel-admin','can:gudang')->group(function (){
         // Barang
         Route::get('/barang', App\Http\Livewire\Admin\Barang\Index::class)->name('barang');

        // Paket
        Route::get('/paket', App\Http\Livewire\Admin\Paket\Index::class)->name('paket');

         // Jenis Barang
         Route::get('/jenis-barang', App\Http\Livewire\Admin\JenisBarang\Index::class)->name('jenis-barang');
    });

    Route::middleware('panel-admin','can:kasir')->group(function (){
        // Transaksi
        Route::get('/transaksi', App\Http\Livewire\Admin\Transaksi\Index::class)->name('transaksi');
        Route::get('/transaksi/create', App\Http\Livewire\Admin\Transaksi\Create::class)->name('transaksi.create');
    });

});
