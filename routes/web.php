<?php

use App\Http\Controllers\AdoptController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('adopt');
});

Route::get('/', [AdoptController::class, 'index'])->name('adopt.index');

