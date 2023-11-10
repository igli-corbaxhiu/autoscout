<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [DashboardController::class, 'index'])->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //if user is admin can access these routes seperated by the middleware
    Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin');
    Route::delete('/car/{car}', [CarController::class, 'destroy'])->name('car.destroy')->middleware('admin');
    Route::post('/car/store', [CarController::class, 'store'])->name('car.store')->middleware('admin');


});

require __DIR__.'/auth.php';
