<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Auth\LogoutController;
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
    // return view('welcome');
    return inertia('Web/Home/Index');
});

Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

Route::prefix('admin')->group(function(){
    Route::group(['middleware' => ['auth', 'role:admin']], function(){
        Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

        // slider
        Route::resource('/sliders', SliderController::class, ['as' => 'admin'])->only(['index', 'store', 'destroy']);

        // category
        Route::resource('/categories', CategoryController::class, ['as' => 'admin'])->except('show');
    });
});
