<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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
    return view('welcome');
});

// Rutas para el login
Route::view('/login',"login")->name('login');
Route::view('/registro',"register")->name('registro');
Route::view('/privada',"secret")->name('privada');

// Rutas para validar el registro
Route::post('/validar-registro',[LoginController::class,'register'])->name('validar-registro');
Route::post('/inicia-sesion',[LoginController::class,'login'])->name('inicia-sesion');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

// Rutas para el panel admin
Route::get('/admin',[HomeController::class,'index'])->name('home');

Route::resource('/products',ProductController::class);

Route::resource('/categories',CategoryController::class);
