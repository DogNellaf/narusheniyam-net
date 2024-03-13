<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViolationsController;

// Main routes

Route::get('/', [MainController::class, 'index'])->name('index');

// Auth routes

Route::get('login', [LoginController::class, 'index'])->name('login-page');
Route::post('login', [LoginController::class, 'login'])->name('login');

Auth::routes();

// Dashboard routes

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Violation routes

Route::get('/home/create', [ViolationsController::class, 'create'])->name('violation.create');
Route::post('/home/create', [ViolationsController::class, 'store'])->name('violation.store');

Route::get('/home/{violation}', [ViolationsController::class, 'edit'])->name('violation.edit');
Route::patch('/home/{violation}', [ViolationsController::class, 'update'])->name('violation.update');
Route::delete('/home/{violation}', [ViolationsController::class, 'destroy'])->name('violation.destroy');

Route::get('/{violation}', [ViolationsController::class, 'detail'])->name('violation.detail');

// Route::get('/home/{violation}/delete', [HomeController::class, 'delete'])->name('violation.delete');