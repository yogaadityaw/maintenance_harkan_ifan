<?php

use App\Http\Controllers\AdminController\AssetController;
use App\Http\Controllers\AdminController\TimeSheetController;
use App\Http\Controllers\AdminController\WorkorderController;
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

//Route::get('/', [AuthController::class, 'showLogin'])->name('page-login');
//Route::post('/login', [AuthController::class, 'authLogin'])->name('login');
//Route::get('/register', [AuthController::class, 'showRegister'])->name('page-register');
//Route::post('/register', [AuthController::class, 'register'])->name('register');

//Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard-admin');
    Route::get('/asset', [AssetController::class, 'index'])->name('asset');


//  Route untuk work order
    Route::get('/timesheet', [TimeSheetController::class, 'index'])->name('timesheet');
    Route::post('/timesheet/create', [TimeSheetController::class, 'createTimesheet'])->name('timesheet-create');
    Route::get('/workorder/{id}', [WorkorderController::class, 'index'])->name('workorder');
    Route::post('/workorder/create', [WorkorderController::class, 'createWorkorder'])->name('workorder-create');

//});
//Route::get('/mencoba', function () {
//    return view('stisla.pages.dashboard.blade.php-ecommerce-dashboard.blade.php');
//});

//Route::prefix('auth')->group(function () {
//Route::get('')
//});


Route::get('/unauthorized', function () {
    return view('error-views.error-403');
})->name('unauthorized');
