<?php

use App\Http\Controllers\AdminController\AssetController;
use App\Http\Controllers\AdminController\WorkOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController\DashboardController;

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

//Route::get('/', function () {
//    return view('login');
//});

Route::get('/', [AuthController::class, 'showLogin'])->name('page-login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('page-register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard-admin');
    Route::get('/asset', [AssetController::class, 'index'])->name('asset');


//  Route untuk work order
    Route::get('/workorder', [WorkOrderController::class, 'index'])->name('workorder');

});
//Route::get('/mencoba', function () {
//    return view('stisla.pages.dashboard.blade.php-ecommerce-dashboard.blade.php');
//});

//Route::prefix('auth')->group(function () {
//Route::get('')
//});
