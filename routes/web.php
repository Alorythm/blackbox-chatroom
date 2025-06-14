<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PublicController::class, 'index'])->name('homepage');
Route::get('/rules', [PublicController::class, 'rules'])->name('rules');

Route::prefix('profile')->group(function () {
    Route::get('/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
});
