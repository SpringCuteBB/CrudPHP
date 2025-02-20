<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('controlPanel');
}) -> name("controlPanel");

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
use App\Http\Controllers\OfferController;
use App\Http\Middleware\CheckOfferCreator;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/create', function () {
        return view('createNewOffer');
    }) -> name("createNewOffer");
    Route::put('/offers/{id}', [OfferController::class, 'update']);
    Route::post('/offers', [OfferController::class, 'store']);
    Route::delete('/offers/{id}', [OfferController::class, 'destroy']);
    Route::get('/edit/{id}', [OfferController::class, 'edit'])->middleware(CheckOfferCreator::class)->name('editOffer');
});

use App\Http\Controllers\UserController;
Route::get('/users', [UserController::class, 'index'])->name('users.index');



Route::get('/view/{id}', [OfferController::class, 'show'])->name('viewOffer');


require __DIR__.'/auth.php';
