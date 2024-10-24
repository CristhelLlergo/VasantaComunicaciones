<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finanzas;

class FinanzasController extends Controller
{
    /**
     * Método para listar todas las finanzas.
     */
    public function index()
    {
        $finanzas = Finanzas::all();
        return view('admin.finanzas.index', compact('finanzas'));
    }

    /**
     * Mostrar el formulario para crear una nueva entrada de finanzas.
     */
    public function create()
    {
        return view('admin.finanzas.create');
    }

    /**
     * Método para almacenar una nueva entrada de finanzas.
     */
    public function store(Request $request)
    {
        Finanzas::create($request->all());
        return redirect()->route('finanzas.index');
    }

    /**
     * Mostrar el formulario para editar una entrada de finanzas.
     */
    public function edit(Finanzas $finanza)
    {
        return view('admin.finanzas.edit', compact('finanza'));
    }

    /**
     * Actualizar una entrada de finanzas en almacenamiento.
     */
    public function update(Request $request, Finanzas $finanza)
    {
        $finanza->update($request->all());
        return redirect()->route('finanzas.index');
    }

    /**
     * Eliminar una entrada de finanzas específica.
     */
    public function destroy(Finanzas $finanza)
    {
        $finanza->delete();
        return back();
    }
}
