<?php

use App\Http\Controllers\DonwloadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DonwloadController::class, 'index']);
