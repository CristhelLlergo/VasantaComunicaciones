<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluaciones; 
use App\Models\Operaciones;

class EvaluacionesController extends Controller
{
    /**
     * Método para listar todas las evaluaciones.
     */
    public function index()
    {
        // Los usuarios solo pueden ver sus propias evaluaciones
        $evaluaciones = Evaluaciones::with('operacion')->where('id_users', auth()->id())->get();
        return view('user.evaluaciones.index', compact('evaluaciones'));
    }

    /**
     * Mostrar el formulario para crear una nueva evaluación.
     */
    public function create()
    {
        return view('user.evaluaciones.crear');
    }

    /**
     * Método para almacenar una nueva evaluación.
     */
    public function store(Request $request)
    {
        // Crear la evaluación, asegurando que el id_users sea el usuario autenticado
        Evaluaciones::create(array_merge($request->all(), ['id_users' => auth()->id()]));

        return redirect()->route('evaluaciones.index');
    }

    /**
     * Mostrar una evaluación específica.
     */
    public function show($id)
    {
        $evaluacion = Evaluaciones::with('operacion')->findOrFail($id);
        return view('user.evaluaciones.show', compact('evaluacion'));
    }

    /**
     * Mostrar el formulario para editar una evaluación.
     */
    public function edit($id)
    {
        $evaluacion = Evaluaciones::findOrFail($id);
        return view('user.evaluaciones.edit', compact('evaluacion'));
    }

    /**
     * Actualizar la evaluación en almacenamiento.
     */
    public function update(Request $request, $id)
    {
        $evaluacion = Evaluaciones::findOrFail($id);
        $evaluacion->update($request->all());

        return redirect()->route('evaluaciones.index');
    }

    /**
     * Eliminar una evaluación.
     */
    public function destroy($id)
    {
        $evaluacion = Evaluaciones::findOrFail($id);
        $evaluacion->delete();
        return back();
    }
}
