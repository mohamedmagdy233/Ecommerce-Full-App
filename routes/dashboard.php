<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/index', [DashboardController::class, 'index']);


    Route::middleware(['auth:admin', 'verified'])->group(function () {
        Route::resource('category', CategoryController::class);

        Route::resource('product', ProductController::class);
    });





    //################################ dashboard user ##########################################
    Route::get('/dashboard/user',[UserController::class,'index'])->middleware(['auth'])->name('dashboard.user');
    //################################ end dashboard user #####################################



    //################################ dashboard admin ########################################
    Route::get('/dashboard/admin', function () {
        return view('Admin.Dashboard');
    })->middleware(['auth:admin'])->name('dashboard.admin')->middleware('auth:admin');

    //################################ end dashboard admin #####################################
































    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';




