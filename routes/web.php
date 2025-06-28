<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\DetailPaketController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('hasil', [AuthController::class, 'hasil'])->name('hasil');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('post-logout', [AuthController::class, 'postLogout'])->name('logout.post');
Route::resource('bookings', BookingController::class);
Route::resource('destinasis', DestinasiController::class);
Route::resource('detail_pakets', DetailPaketController::class);
Route::resource('pakets', PaketController::class);
Route::resource('pembayarans', PembayaranController::class);
Route::resource('transportasis', TransportasiController::class);
Route::resource('hotels', HotelController::class);
Route::resource('ulasans', UlasanController::class);
Route::resource('penggunas', PenggunaController::class);
Route::resource('roles', RoleController::class);
Route::get("/", [AuthController::class, 'landing'])->name('landing');
Route::get('detail-paket/{id}', [BookingController::class, 'summary'])->name('paket.summary');
Route::get('/detail_pakets/{detail_paket}', [DetailPaketController::class, 'show'])->name('detail_pakets.show');
Route::post('/pembayaran_transfer', [PembayaranController::class, 'transfer'])->name('pembayaran.transfer');
Route::post('/pembayaran_upload', [PembayaranController::class, 'upload'])->name('pembayarans.upload');
// Rute untuk user (frontend)
Route::middleware('auth')->group(function () {
    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
});


// Route::post('/konfirmasi-booking', [BookingController::class, 'confirm'])->name('konfirmasi.booking');
Route::post('/bookings/{id}/confirm', [BookingController::class, 'confirm'])->name('konfirmasi.booking');

// Route untuk memproses pembayaran (menggunakan metode POST karena mengirim data form)
Route::post('/pembayaran/process', [PembayaranController::class, 'processPembayaran'])->name('pembayaran.process');

// Route untuk menampilkan status pembayaran (menerima parameter status)
Route::get('/pembayaran/status/{status}', [PembayaranController::class, 'showPembayaranStatus'])->name('payment.status');
Route::get('book', function () {
    if (Auth::check()) {
        // User sudah login
        return redirect()->route('bookings.create'); // contoh redirect ke halaman booking dengan id paket 1
    } else {
        // User belum login
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk memesan.');
    }
})->name('book');
