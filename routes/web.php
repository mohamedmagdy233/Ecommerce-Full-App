<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});




Route::get('/index', [DashboardController::class,'index'])->middleware(['auth', 'verified']);
Route::get('user/show/{id}', [UserController::class, 'show']);


Route::resource('category',CategoryController::class);


//=======================================Start Socialite =================================
Route::get('/auth/{provider}/redirect',[ProviderController::class,'redirect']);
Route::get('/auth/{provider}/callback',[ProviderController::class,'callback']);
//=======================================End Socialite =================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
