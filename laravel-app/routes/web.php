<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\stateContruller;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Models\User;
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
Route::get('student',[StudentController::class,'index']);
Route::resource('student', StudentController::class);
Route::get('country-state',[CountryController::class,'getState'])->name('country-state');
Route::resource('country',CountryController::class);
Route::resource('state',StateContruller::class);
Route::resource('city',CityController::class);


Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
});

