<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SettingController;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('employees', EmployeeController::class);
Route::resource('references', ReferenceController::class);
Route::resource('overtimes', OvertimeController::class);
Route::resource('settings', SettingController::class);

Route::get('overtime-pays/calculate', [EmployeeController::class, "calculate"]);
