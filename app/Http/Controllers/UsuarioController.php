<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{

    /**
     * Método de la clase UsuarioController para traer todos los usuarios
     */
    public function index()
    {
        $usuarios = User::all();
        //debera retornar a la vista donde vas a reflejar todos los usuarios
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.crear_usuario');
    }

    /**
     * Método para crear un usuario
     */
    public function store(Request $request)
    {
        $usuario = User::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.ver_usuario', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        return view('admin.usuarios.editar_usuario', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        $usuario->update($request->all());
        return redirect()->route('usuarios.edit', $usuario);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::find($id);
        // eliminando el usuario
        $usuario->delete();
        return back();
    }
}
