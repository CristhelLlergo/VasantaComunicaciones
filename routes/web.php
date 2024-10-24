<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermisoController; // Corregido el nombre de la clase
use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\FinanzasController;
use App\Http\Controllers\OperacionesController;
use App\Http\Controllers\ReportesOperativosController;
use App\Http\Controllers\UsuarioController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas para el módulo de Evaluaciones (solo User)
Route::get('/user/evaluaciones', [EvaluacionesController::class, 'index'])->name('evaluaciones.index'); // Ver evaluaciones
Route::post('/user/evaluaciones', [EvaluacionesController::class, 'store'])->name('evaluaciones.store'); // Crear evaluaciones
Route::get('/user/evaluaciones/{id}', [EvaluacionesController::class, 'show'])->name('evaluaciones.show'); // Mostrar evaluación
Route::put('/user/evaluaciones/{id}', [EvaluacionesController::class, 'update'])->name('evaluaciones.update'); // Editar evaluación
Route::delete('/user/evaluaciones/{id}', [EvaluacionesController::class, 'destroy'])->name('evaluaciones.destroy'); // Eliminar evaluación

// Rutas para el módulo de Operaciones (admin/User)
Route::get('/admin/user/operaciones', [OperacionesController::class, 'index'])->name('operaciones.index'); // Ver operaciones
Route::post('/user/operaciones', [OperacionesController::class, 'store'])->name('operaciones.store'); // Crear operaciones
Route::get('/user/operaciones/{id}', [OperacionesController::class, 'show'])->name('operaciones.show'); // Mostrar operación
Route::put('/user/operaciones/{id}', [OperacionesController::class, 'update'])->name('operaciones.update'); // Editar operación
Route::delete('/user/operaciones/{id}', [OperacionesController::class, 'destroy'])->name('operaciones.destroy'); // Eliminar operación

// Rutas para el módulo de Finanzas (Solo admin)
Route::get('/admin/finanzas', [FinanzasController::class, 'index'])->name('finanzas.index'); // Ver finanzas
Route::post('/admin/finanzas', [FinanzasController::class, 'store'])->name('finanzas.store'); // Crear finanzas
Route::get('/admin/finanzas/{id}', [FinanzasController::class, 'show'])->name('finanzas.show'); // Mostrar finanza
Route::put('/admin/finanzas/{id}', [FinanzasController::class, 'update'])->name('finanzas.update'); // Editar finanza
Route::delete('/admin/finanzas/{id}', [FinanzasController::class, 'destroy'])->name('finanzas.destroy'); // Eliminar finanza

// Rutas para el módulo de Reportes (Solo admin/User)
Route::get('/admin/user/reportes', [ReportesOperativosController::class, 'index'])->name('reportes.index'); // Ver reportes
Route::post('/user/reportes', [ReportesOperativosController::class, 'store'])->name('reportes.store'); // Crear reportes
Route::get('/user/reportes/{id}', [ReportesOperativosController::class, 'show'])->name('reportes.show'); // Mostrar reporte
Route::put('/user/reportes/{id}', [ReportesOperativosController::class, 'update'])->name('reportes.update'); // Editar reporte
Route::delete('/user/reportes/{id}', [ReportesOperativosController::class, 'destroy'])->name('reportes.destroy'); // Eliminar reporte
Route::get('/user/reportes/download/{id}', [ReportesOperativosController::class, 'download'])->name('reportes.download'); // Descargar reporte

// Rutas para el módulo de Catálogos (Solo admin/User)
Route::get('/admin/user/catalogos', [CatalogosController::class, 'index'])->name('catalogos.index'); // Ver catálogos
Route::post('/user/catalogos', [CatalogosController::class, 'store'])->name('catalogos.store'); // Crear catálogos
Route::get('/user/catalogos/{id}', [CatalogosController::class, 'show'])->name('catalogos.show'); // Mostrar catálogo
Route::put('/user/catalogos/{id}', [CatalogosController::class, 'update'])->name('catalogos.update'); // Editar catálogo
Route::delete('/user/catalogos/{id}', [CatalogosController::class, 'destroy'])->name('catalogos.destroy'); // Eliminar catálogo
Route::get('/user/catalogos/download/{id}', [CatalogosController::class, 'download'])->name('catalogos.download'); // Descargar catálogo

// Rutas para el módulo de Permisos (Solo admin)
Route::get('/admin/permisos', [PermisoController::class, 'index'])->name('permisos.index'); // Ver permisos
Route::post('/admin/permisos', [PermisoController::class, 'store'])->name('permisos.store'); // Crear permisos
Route::get('/admin/permisos/{id}', [PermisoController::class, 'show'])->name('permisos.show'); // Mostrar permiso
Route::put('/admin/permisos/{id}', [PermisoController::class, 'update'])->name('permisos.update'); // Editar permiso
Route::delete('/admin/permisos/{id}', [PermisoController::class, 'destroy'])->name('permisos.destroy'); // Eliminar permiso

// Rutas para el módulo de Roles (Solo admin)
Route::get('/admin/roles', [RoleController::class, 'index'])->name('roles.index'); // Ver roles
Route::post('/admin/roles', [RoleController::class, 'store'])->name('roles.store'); // Crear roles
Route::get('/admin/roles/{id}', [RoleController::class, 'show'])->name('roles.show'); // Mostrar rol
Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('roles.update'); // Editar rol
Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy'); // Eliminar rol

// Rutas para el módulo de Usuarios (Solo admin)
Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index'); // Ver usuarios
Route::post('/admin/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store'); // Crear usuarios
Route::get('/admin/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show'); // Mostrar usuario
Route::put('/admin/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update'); // Editar usuario
Route::delete('/admin/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy'); // Eliminar usuario
