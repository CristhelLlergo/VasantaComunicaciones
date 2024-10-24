<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogos;
use Illuminate\Support\Facades\Storage;

class CatalogosController extends Controller
{
    /**
     * Método para listar todos los catálogos.
     */
    public function index()
    {
        $catalogos = Catalogos::all(); 
        return view('catalogos.index', compact('catalogos'));
    }
    public function store(Request $request)
    {
    // Crear una nueva instancia de Catalogos con los datos recibidos
    Catalogos::create($request->all());

    // Redirigir al índice de catálogos con un mensaje de éxito
    return redirect()->route('catalogos.index');
   }  

    /**
     * Mostrar un catálogo específico.
     */
    public function show(Catalogos $catalogo)
    {
        return view('catalogos.show', compact('catalogo'));
    }

    /**
     * Mostrar el formulario para editar un catálogo específico.
     */
    public function edit(Catalogos $catalogo)
    {
        return view('catalogos.editar', compact('catalogo'));
    }

    /**
     * Actualizar el catálogo en almacenamiento.
     */
    public function update(Request $request, Catalogos $catalogo)
    {
        $catalogo->update($request->all());
        return redirect()->route('catalogos.index');
    }

    /**
     * Eliminar un catálogo específico.
     */
    public function destroy(Catalogos $catalogo)
    {
        // Elimina el archivo PDF asociado antes de borrar el catálogo
        if ($catalogo->pdf_document) {
            Storage::disk('public')->delete($catalogo->pdf_document);
        }

        $catalogo->delete();
        return redirect()->route('catalogos.index');
    }

    /**
     * Descargar el archivo PDF de un catálogo específico.
     */
    public function downloadPdf(Catalogos $catalogo)
    {
        $filePath = storage_path('app/public/' . $catalogo->pdf_document);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->route('catalogos.index');
    }
}
