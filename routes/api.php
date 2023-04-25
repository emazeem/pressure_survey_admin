<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IndexController;

Route::get('fetch-teams', [IndexController::class, 'getTeams']);
Route::post('get-user-from-team', [IndexController::class, 'getUserFromTeam']);
Route::post('ip-list-from-file', [IndexController::class, 'fetchIpList']);
Route::post('create-inspection-point', [IndexController::class, 'createInspectionPoint']);
Route::post('files-of-team', [IndexController::class, 'filesOfTeam']);
Route::post('store-meters-against-ip', [IndexController::class, 'storeMetersAgainstIp']);
Route::post('get-file-data', [IndexController::class, 'getFileData']);
Route::post('get-selected-meters', [IndexController::class, 'getSelectedMeters']);
Route::post('update-file-data', [IndexController::class, 'updateFileData']);
Route::post('update-images', [IndexController::class, 'updateImages']);
Route::post('fetch-images', [IndexController::class, 'fetchImages']);
Route::post('fetch-meter-list-of-ip', [IndexController::class, 'fetchMeterListOfList']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('gallery')->group(function () {
    });
});

//github token
// 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
