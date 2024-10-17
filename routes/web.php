<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\FinanzasController;
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
$user = User::find(1);
$user->assignRole('admin');


echo $user->hasPermissions('Reportes_operativos_create') 
    ? "El usuario tiene permiso para crear reportes operativos." 
    : "El usuario no tiene permiso para crear reportes operativos.";

   
    return view('welcome');
   
});

