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


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //if user is admin can access these routes seperated by the middleware
    Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin');
    Route::delete('/car/{car}', [CarController::class, 'destroy'])->name('car.destroy')->middleware('admin');
    Route::post('/car/store', [CarController::class, 'store'])->name('car.store')->middleware('admin');
    Route::post('/car/get', [CarController::class, 'index'])->name('car.get')->middleware('admin');
    Route::put('/car/update', [CarController::class, 'update'])->name('car.update')->middleware('admin');

});

// routes for car-related actions
Route::post('/cart/add/{carId}', [CarController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{carId}', [CarController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/show', [CarController::class, 'showCart'])->name('cart.show');
Route::get('/checkout', [CarController::class, 'checkout'])->name('checkout');


require __DIR__.'/auth.php';
