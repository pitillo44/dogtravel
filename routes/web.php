<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\reservaController;

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

Route::get('/azucar', function () {
    return view('welcome');
});
Route::view('/index', 'index');
Route::get('/reservas/{id}', [reservaController::class, 'show'])->name('reservas.show');
Route::post('/reservas/create/{id}', [reservaController::class, 'store'])->name('reservas.store');

