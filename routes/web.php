<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [NoteController::class, 'index'])->name('dashboard');
    Route::post('/notes', [NoteController::class, 'store']);
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit']);
    Route::put('/notes/{note}', [NoteController::class, 'update']);
    Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
});

Route::view('/offline', 'offline');

require __DIR__ . '/auth.php';
