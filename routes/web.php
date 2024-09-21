<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/qrcode.create', function () {
    return view('qrcode.create');
});
Route::get('/qrcode.show', function () {
    return view('qrcode.show');
});
Route::get('/qrcode.qrcode', function () {
    return view('qrcode.qrcode');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/qrcodes/create', [QrCodeController::class, 'create'])->name('qrcodes.create');
Route::post('/qrcodes/store', [QrCodeController::class, 'store'])->name('qrcodes.store');
Route::get('/qrcodes/{id}', [QrCodeController::class, 'show'])->name('qrcodes.show');
Route::get('/qrcodes/{id}/generate', [QrCodeController::class, 'generateQrCode'])->name('qrcodes.generate');
#Route::post('/qrcodes/store', [QrCodeController::class, 'store'])->name('qrcodes.store');
#Route::post('/qrcodes/generate', [QrCodeController::class, 'generateQrCode'])->name('qrcodes.generate');

#Route::get('/', [QrCodeController::class, 'index']);
#Route::post('/generate', [QrCodeController::class, 'generate'])->name('generate.qr');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
