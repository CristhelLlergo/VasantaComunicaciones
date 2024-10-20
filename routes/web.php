<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\FinanzasController;
use App\Http\Controllers\RoleController;

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
//prueba con esta ruta
// Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');


