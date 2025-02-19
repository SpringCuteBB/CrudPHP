<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\OfferController;
Route::get('/offers', [OfferController::class, 'index']);
