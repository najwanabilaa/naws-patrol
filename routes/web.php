<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AnimalReportController;
use App\Http\Controllers\EducationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdoptController;
use App\Http\Controllers\FosterHomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{donation}/payment', [DonationController::class, 'payment'])->name('donations.payment');
    Route::get('/donations/{donation}/success', [DonationController::class, 'success'])->name('donations.success');
    Route::get('/donations/{donation}/check-status', [DonationController::class, 'checkStatus'])->name('donations.check-status');

    Route::get('/animal-report', [AnimalReportController::class, 'index'])->name('animal-report.index');
    Route::get('/animal-report/create', [AnimalReportController::class, 'create'])->name('animal-report.create');
    Route::post('/animal-report', [AnimalReportController::class, 'store'])->name('animal-report.store');
    Route::get('/animal-report/{animalReport}', [AnimalReportController::class, 'show'])->name('animal-report.show');
    Route::patch('/animal-report/{animalReport}/status', [AnimalReportController::class, 'updateStatus'])->name('animal-report.update-status');

    Route::resource('educations', EducationsController::class);

    Route::get('/adopt', [AdoptController::class, 'index'])->name('adopt.index');
    Route::get('/adopt/detail/{id}', [AdoptController::class, 'detail'])->name('adopt.detail');
    Route::get('/adopt/form', [AdoptController::class, 'form'])->name('adopt.form');
    Route::post('/adopt/form', [AdoptController::class, 'submitForm'])->name('adopt.form.submit');
    Route::get('/adopt/confirm', [AdoptController::class, 'confirm'])->name('adopt.confirm');
    Route::post('/adopt/confirm', [AdoptController::class, 'confirmSubmit'])->name('adopt.confirm.submit');
    Route::get('/adopt/success', [AdoptController::class, 'success'])->name('adopt.success');
    Route::get('/adopt/status', [AdoptController::class, 'adoptStatus'])->name('adopt.status');
    Route::get('/adopt/help', [AdoptController::class, 'help'])->name('adopt.help');
    Route::get('/adopt/terms', [AdoptController::class, 'terms'])->name('adopt.terms');
    Route::get('/api/pets', [AdoptController::class, 'getPets'])->name('api.pets');
    Route::get('/api/adoption-status', [AdoptController::class, 'getAdoptionStatus'])->name('api.adoption.status');
    Route::get('/api/adoption/{id}', [AdoptController::class, 'getAdoptionDetail'])->name('api.adoption.detail');
    Route::delete('/api/adoption/{id}/cancel', [AdoptController::class, 'cancel'])->name('api.adoption.cancel');

    Route::get('/foster-home', [FosterHomeController::class, 'showForm'])->name('fosterHome.form');
    Route::get('/foster/landing', [FosterHomeController::class, 'landing'])->name('foster.landing');
    Route::get('/foster/info', [FosterHomeController::class, 'info'])->name('foster.info');
    Route::get('/foster/needs', [FosterHomeController::class, 'needs'])->name('foster.needs');
    Route::get('/foster/form/{id}', [FosterHomeController::class, 'fosterForm'])->name('foster.form');
    Route::post('/foster/accept', [FosterHomeController::class, 'accept'])->name('foster.accept');
    Route::get('/foster/accepted', [FosterHomeController::class, 'accepted'])->name('foster.accepted');
});

require __DIR__.'/auth.php';
