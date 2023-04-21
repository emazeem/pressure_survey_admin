<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FileController;

Route::middleware(['auth', 'can:super-admin-views'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::prefix('team')->group(function () {
        Route::get('', [TeamController::class, 'index'])->name('team');
        Route::post('fetch', [TeamController::class, 'fetch'])->name('team.fetch');
        Route::post('submit', [TeamController::class, 'submit'])->name('team.submit');
        Route::post('edit', [TeamController::class, 'edit'])->name('team.edit');
        Route::post('destroy', [TeamController::class, 'destroy'])->name('team.destroy');
    });
    Route::prefix('member')->group(function () {
        Route::get('', [MemberController::class, 'index'])->name('member');
        Route::post('fetch', [MemberController::class, 'fetch'])->name('member.fetch');
        Route::post('submit', [MemberController::class, 'submit'])->name('member.submit');
        Route::post('edit', [MemberController::class, 'edit'])->name('member.edit');
        Route::post('destroy', [MemberController::class, 'destroy'])->name('member.destroy');
    });
    Route::prefix('file')->group(function () {
        Route::get('', [FileController::class, 'index'])->name('import');
        Route::get('show/{id}', [FileController::class, 'show'])->name('import.show');
        Route::post('fetch', [FileController::class, 'fetch'])->name('import.fetch');
        Route::post('submit', [FileController::class, 'submit'])->name('import.submit');
        Route::post('edit', [FileController::class, 'edit'])->name('import.edit');
        Route::post('destroy', [FileController::class, 'destroy'])->name('import.destroy');
        Route::post('assign/teams', [FileController::class, 'assign_team'])->name('import.assign.team');
    });

});
