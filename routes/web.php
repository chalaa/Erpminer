<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportLayoutController;
use App\Http\Controllers\ReportColumnDataController;
use App\View\Components\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/reports',[ReportController::class,'reportList'])->name('report.list');
    Route::get('/addreport',[ReportController::class, 'create'])->name('report.create');
    Route::post('/addreport',[ReportController::class,'store'])->name('report.store');


    Route::get('/columndata/{id}',[ReportColumnDataController::class, 'create'])->name('column.create');
    Route::post('/columndata/{id}',[ReportColumnDataController::class, 'store'])->name('column.store');

    Route::get('/addlayout/{id}',[ReportLayoutController::class,'create'])->name('layout.create');
    Route::post('/addlayout/{id}',[ReportLayoutController::class,'store'])->name('layout.store');
});

require __DIR__.'/auth.php';
