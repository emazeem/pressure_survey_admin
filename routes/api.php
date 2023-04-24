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

Route::get('fetch-teams', [IndexController::class, 'getTeams']);
Route::post('get-user-from-team', [IndexController::class, 'getUserFromTeam']);
Route::post('ip-list-from-file', [IndexController::class, 'fetchIpList']);
Route::post('create-inspection-point', [IndexController::class, 'createInspectionPoint']);
Route::post('files-of-team', [IndexController::class, 'filesOfTeam']);
Route::post('store-meters-against-ip', [IndexController::class, 'storeMetersAgainstIp']);
Route::post('get-file-data', [IndexController::class, 'getFileData']);
Route::post('get-selected-meters', [IndexController::class, 'getSelectedMeters']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('gallery')->group(function () {
    });
});

//github token
// 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
