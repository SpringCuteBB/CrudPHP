<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('controlPanel');
}) -> name("controlPanel");

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/create', function () {
        return view('createNewOffer');
    }) -> name("createNewOffer");
});

use App\Http\Controllers\UserController;
Route::get('/users', [UserController::class, 'index'])->name('users.index');

use App\Http\Controllers\OfferController;

Route::post('/offers', [OfferController::class, 'store'])->middleware('auth');


require __DIR__.'/auth.php';
