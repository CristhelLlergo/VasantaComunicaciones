<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operaciones;

class OperacionesController extends Controller
{
    /**
     * Método para listar todas las operaciones.
     */
    public function index()
    {
        $operaciones = Operaciones::all();
        return view('operaciones.index', compact('operaciones'));
    }

    /**
     * Mostrar el formulario para crear una nueva operación.
     */
    public function create()
    {
        return view('operaciones.create');
    }

    /**
     * Método para almacenar una nueva operación.
     */
    public function store(Request $request)
    {
        Operaciones::create($request->all());
        return redirect()->route('operaciones.index');
    }

    /**
     * Mostrar el formulario para editar una operación.
     */
    public function edit(Operaciones $operacion)
    {
        return view('operaciones.edit', compact('operacion'));
    }

    /**
     * Actualizar una operación en almacenamiento.
     */
    public function update(Request $request, Operaciones $operacion)
    {
        $operacion->update($request->all());
        return redirect()->route('operaciones.index');
    }

    /**
     * Eliminar una operación específica.
     */
    public function destroy(Operaciones $operacion)
    {
        $operacion->delete();
        return back();
    }
}

