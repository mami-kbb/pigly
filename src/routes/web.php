<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register/step1', [AuthController::class, 'showStep1']);
Route::post('/register/step1', [AuthController::class, 'storeStep1']);
Route::get('/register/step2', [AuthController::class, 'showStep2']);
Route::post('/register/step2', [AuthController::class, 'storeStep2']);
Route::prefix('weight_logs')->group(function () {
    Route::get('/', [WeightLogController::class, 'index']);
    Route::get('/search', [WeightLogController::class, 'search']);
    Route::get('/goal_setting', [WeightLogController::class, 'show']);
    Route::patch('/goal_setting', [WeightLogController::class, 'goalUpdate']);
    Route::post('/create', [WeightLogController::class, 'store']);
    Route::get('/{weightLogId}', [WeightLogController::class, 'detail']);
    Route::patch('/{weightLogId}/update', [WeightLogController::class, 'logUpdate']);
    Route::delete('/{weightLogId}/delete', [WeightLogController::class, 'destroy']);
});
