<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IndexController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('fetch-teams', [IndexController::class, 'getTeams']);
Route::post('get-user-from-team', [IndexController::class, 'getUserFromTeam']);
Route::post('create-inspection-point', [IndexController::class, 'createInspectionPoint']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('gallery')->group(function () {
    });
});

//github token
// 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
