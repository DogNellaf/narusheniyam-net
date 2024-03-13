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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Violation routes

Route::get('/home/create', [HomeController::class, 'create'])->name('violation.create');
Route::post('/home/create', [HomeController::class, 'store'])->name('violation.store');

Route::get('/home/{violation}', [HomeController::class, 'edit'])->name('violation.edit');
Route::patch('/home/{violation}', [HomeController::class, 'update'])->name('violation.update');
Route::delete('/home/{violation}', [HomeController::class, 'destroy'])->name('violation.destroy');

Route::get('/{violation}', [ViolationsController::class, 'detail'])->name('violation.detail');

// Route::get('/home/{violation}/delete', [HomeController::class, 'delete'])->name('violation.delete');