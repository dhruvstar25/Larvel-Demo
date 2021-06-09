<?php

use App\Http\Controllers\citycontroller;
use App\Http\Controllers\employeecontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\statecontroller;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/state', [statecontroller::class, 'getAllState']);
Route::get('/citybyState/{id}', [citycontroller::class, 'getCityByStateId']);
Route::get('/deleteEmployee/{id}', [employeecontroller::class, 'deleteEmployee']);
Route::get('/getEmployeeById/{id}', [employeecontroller::class, 'getEmployeeById']);
