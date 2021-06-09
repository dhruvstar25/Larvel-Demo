<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeecontroller;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [employeecontroller::class, 'show'])->middleware(['auth']);
require __DIR__ . '/auth.php';


Route::post('/store', [employeecontroller::class, 'store'])->middleware(['auth']);
Route::get('/add', [employeecontroller::class, 'add'])->middleware(['auth']);
Route::get('/employeelist', [employeecontroller::class, 'show'])->middleware(['auth']);
Route::get('/edit/{id}', [employeeController::class, 'edit'])->middleware(['auth']);
Route::post('/update', [employeeController::class, 'update'])->middleware(['auth']);
