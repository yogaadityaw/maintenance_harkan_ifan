<?php

use App\Http\Controllers\AdminController\AssetController;
use App\Http\Controllers\AdminController\TimeSheetController;
use App\Http\Controllers\AdminController\WorkorderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\AdminController\DetailController;

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
Route::get('/testview', function () {
    return view('stisla.pages.components-table');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard-admin');
Route::get('/asset', [AssetController::class, 'index'])->name('asset');


//  Route untuk timehseet
Route::get('/timesheet', [TimeSheetController::class, 'index'])->name('timesheet');
Route::post('/timesheet/create', [TimeSheetController::class, 'createTimesheet'])->name('timesheet-create');
Route::get('/timesheet/get-timesheet-data/{id}', [TimeSheetController::class, 'getDataById'])->name('timesheet-get-data');
Route::put('/timeeet/update', [TimeSheetController::class, 'edit'])->name('timesheet-edit');
Route::delete('/timesheet/delete', [TimeSheetController::class, 'delete'])->name('timesheet-delete');

//  Route untuk work order
Route::get('/workorder/{id}', [WorkorderController::class, 'index'])->name('workorder');
Route::post('/workorder/create', [WorkorderController::class, 'createWorkorder'])->name('workorder.create');
Route::put('/workorder/update', [WorkorderController::class, 'editWorkorder'])->name('workorder-edit');
Route::delete('/workorder/delete', [WorkorderController::class, 'deleteWorkorder'])->name('workorder-delete');



Route::get('job-workorder', [DetailController::class, 'getJobsWorkorder'])->name('job-workorder');

Route::get('/get-job-byWorkorder', [DetailController::class, 'getJobsWorkorder'])->name('job-byworkorder');




// Route untuk Job

Route::post('/job/add-job', [WorkorderController::class, 'createJob'])->name('job-add');
//Route::get('/job/get-job-data', [WorkorderController::class, 'getJobList'])->name('job-get-data');
Route::delete('/job/delete-job', [WorkorderController::class, 'deleteJob'])->name('job.delete');
Route::put('/job/update-job', [WorkorderController::class, 'editJob'])->name('job-edit');


Route::get('/unauthorized', function () {
    return view('error-views.error-403');
})->name('unauthorized');
