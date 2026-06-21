<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViolationsController;

Route::get('/', [MainController::class, 'index'])->name('index');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/user', [HomeController::class, 'user_info'])->name('user.info');
    Route::patch('/home/user', [HomeController::class, 'user_save'])->name('user.info.save');

    Route::get('/home/create', [ViolationsController::class, 'create'])->name('violation.create');
    Route::post('/home/create', [ViolationsController::class, 'store'])->name('violation.store');

    Route::get('/violations/{violation}', [ViolationsController::class, 'detail'])->name('violation.detail');

    Route::middleware('admin')->group(function () {
        Route::get('/home/{violation}', [ViolationsController::class, 'edit'])->name('violation.edit');
        Route::patch('/home/{violation}', [ViolationsController::class, 'update'])->name('violation.update');
        Route::delete('/home/{violation}', [ViolationsController::class, 'destroy'])->name('violation.destroy');
    });
});
