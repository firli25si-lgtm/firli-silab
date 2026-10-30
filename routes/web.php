<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SiLab
|--------------------------------------------------------------------------
*/

// Welcome / Landing Page SiLab Guest
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Guest Pages (Sesuai folder silab-guest)
Route::get('/about', fn () => view('guest.about'))->name('guest.about');
Route::get('/about.html', fn () => view('guest.about'));

Route::get('/service', fn () => view('guest.service'))->name('guest.service');
Route::get('/service.html', fn () => view('guest.service'));

Route::get('/project', fn () => view('guest.project'))->name('guest.project');
Route::get('/project.html', fn () => view('guest.project'));

Route::get('/contact', fn () => view('guest.contact'))->name('guest.contact');
Route::get('/contact.html', fn () => view('guest.contact'));

Route::get('/feature', fn () => view('guest.feature'))->name('guest.feature');
Route::get('/feature.html', fn () => view('guest.feature'));

Route::get('/quote', fn () => view('guest.quote'))->name('guest.quote');
Route::get('/quote.html', fn () => view('guest.quote'));

Route::get('/team', fn () => view('guest.team'))->name('guest.team');
Route::get('/team.html', fn () => view('guest.team'));

Route::get('/testimonial', fn () => view('guest.testimonial'))->name('guest.testimonial');
Route::get('/testimonial.html', fn () => view('guest.testimonial'));

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kategori
    Route::resource('kategori', KategoriController::class);

    // Data Barang / Alat (Mendukung path /data-barang, /data-barang.html, dan /alat)
    Route::get('/data-barang', function () {
        $alat = \App\Models\Alat::with('kategori')->paginate(10);
        return view('data-barang', compact('alat'));
    })->name('data-barang');
    Route::get('/data-barang.html', fn () => redirect()->route('data-barang'));

    // Alat
    Route::resource('alat', AlatController::class);
    Route::patch('alat/{alat}/stock', [AlatController::class, 'updateStock'])
        ->name('alat.stock');

    // Modul CRUD User (Sesuai tugas Firli 'CRUD User dan Partial View')
    Route::resource('users', UserController::class);
    Route::get('/user.html', fn () => redirect()->route('users.index'));
    Route::get('/user-form.html', fn () => redirect()->route('users.create'));

    // Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
    
    // Peminjaman Actions (Admin only - will add middleware later)
    Route::prefix('peminjaman/{peminjaman}')->group(function () {
        Route::post('approve', [PeminjamanController::class, 'approve'])
            ->name('peminjaman.approve');
        Route::post('reject', [PeminjamanController::class, 'reject'])
            ->name('peminjaman.reject');
        Route::post('mark-as-borrowed', [PeminjamanController::class, 'markAsBorrowed'])
            ->name('peminjaman.mark-as-borrowed');
        Route::post('return', [PeminjamanController::class, 'returnItem'])
            ->name('peminjaman.return');
    });
});

require __DIR__.'/auth.php';
