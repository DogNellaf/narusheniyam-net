<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ViolationsController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\CustomLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ViolationsController::class, 'index'])->name('index');
Route::get('login', [CustomLoginController::class, 'index'])->name('login');
Route::post('custom-login', [CustomLoginController::class, 'customLogin'])->name('login.custom');

Auth::routes();

Route::get('/home/create', [HomeController::class, 'create'])->name('violation.create');
Route::post('/home', [HomeController::class, 'store'])->name('violation.store');
Route::get('/home/{violation}/edit', [HomeController::class, 'edit'])->name('violation.edit');
Route::patch('/home/{violation}', [HomeController::class, 'update'])->name('violation.update');
Route::get('/home/{violation}/delete', [HomeController::class, 'delete'])->name('violation.delete');
Route::delete('/home/{violation}', [HomeController::class, 'destroy'])->name('violation.destroy');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{violation}', [ViolationsController::class, 'detail'])->name('detail');