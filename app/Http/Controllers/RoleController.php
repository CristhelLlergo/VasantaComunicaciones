<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    /**
     * Método de la clase RoleController para traer todos los roles
     */
    public function index()
    {
        $role = Role::all();
        //chepi, aqui deberas retornar a la vista donde vas a reflejar todos los roles (CAMBIALO A TU RUTA VERDADERA)
        return view('admin.evaluaciones', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Método para crear un rol
     */
    public function store(Request $request)
    {
        //chepi, comenté el segundo ya que debes colocar el nombre que le pusistes al input donde estas guardando el nombre del rol en la vista
        $role = Role::create(['name' => $request]);
        // $role = Role::create(['name' => $request->input('nombreDelInput')])
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
