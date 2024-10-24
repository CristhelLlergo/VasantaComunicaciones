<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AsignarController extends Controller
{
    
    public function index()
    {
        $user = User::all();
        //chepi, aqui deberas retornar a la vista donde vas a reflejar todos los roles (CAMBIALO A TU RUTA VERDADERA)
        return view('admin.usuarios.tablaIndex', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.usuarios.userRol', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        return redirect()->route('asignar.edit', $user);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
