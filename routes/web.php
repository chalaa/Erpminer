<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportLayoutController;
use App\Http\Controllers\ReportColumnDataController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', [ReportController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

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

    Route::get('/reportcolumn/{id}',[ReportColumnDataController::class,'index'])->name('report.column');

    Route::get('/userlayout',[ReportLayoutController::class,'userlayout'])->name('user.layout');
    Route::get('/userlayout/{id}',[ReportLayoutController::class,'createuserlayout'])->name('create.user.layout');
    Route::post('/userlayout/{id}',[ReportLayoutController::class,'userlayoutstore'])->name('user.layout.store');

    Route::get('/layoutList',[ReportLayoutController::class,'layoutList'])->name('layoutList');
    Route::get('/editlayout/{id}',[ReportLayoutController::class,'layoutEdit'])->name('layoutEdit');
    Route::put('/editlayout/{id}',[ReportLayoutController::class,'layoutUpdate'])->name('layoutUpdate');
    Route::delete('/deletelayout/{id}',[ReportLayoutController::class,'destroy'])->name('deletelayout');
    Route::get('/reordercolumn/{id}',[ReportLayoutController::class,'reordercolumn'])->name('reordercolumn');
    Route::put('/reordercolumn/{id}',[ReportLayoutController::class,'columnUpdate'])->name('columnUpdate');
    Route::put('/updateDefault/{id}/{id2}',[ReportLayoutController::class,'updateDefault'])->name('updateDefault');

});

require __DIR__.'/auth.php';
