<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\IndexController;

Route::get('fetch-teams', [IndexController::class, 'getTeams']);
Route::post('get-user-from-team', [IndexController::class, 'getUserFromTeam']);
Route::post('create-inspection-point', [IndexController::class, 'createInspectionPoint']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('gallery')->group(function () {
    });
});