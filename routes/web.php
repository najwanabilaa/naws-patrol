<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AnimalReportController;
use App\Http\Controllers\EducationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Donation routes
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{donation}/payment', [DonationController::class, 'payment'])->name('donations.payment');
    Route::get('/donations/{donation}/success', [DonationController::class, 'success'])->name('donations.success');
    Route::get('/donations/{donation}/check-status', [DonationController::class, 'checkStatus'])->name('donations.check-status');

    // Animal report routes
    Route::get('/animal-report', [AnimalReportController::class, 'index'])->name('animal-report.index');
    Route::get('/animal-report/create', [AnimalReportController::class, 'create'])->name('animal-report.create');
    Route::post('/animal-report', [AnimalReportController::class, 'store'])->name('animal-report.store');
    Route::get('/animal-report/{animalReport}', [AnimalReportController::class, 'show'])->name('animal-report.show');
    Route::patch('/animal-report/{animalReport}/status', [AnimalReportController::class, 'updateStatus'])->name('animal-report.update-status');

    // Education routes
    Route::resource('educations', EducationsController::class);
});

require __DIR__.'/auth.php';
