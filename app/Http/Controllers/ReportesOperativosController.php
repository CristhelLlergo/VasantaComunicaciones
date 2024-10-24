<?php

namespace App\Http\Controllers;

use App\Models\ReportesOperativos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportesOperativosController extends Controller
{
    /**
     * Método para listar todos los reportes operativos.
     */
    public function index()
    {
        $reportes = ReportesOperativos::all();
        return view('reportes.index', compact('reportes'));
    }

    /**
     * Mostrar el formulario para crear un nuevo reporte operativo.
     */
    public function create()
    {
        return view('reportes.create');
    }

    /**
     * Método para almacenar un nuevo reporte operativo.
     */
    public function store(Request $request)
    {
        ReportesOperativos::create($request->all());
        return redirect()->route('reportes.index');
    }

    /**
     * Mostrar el formulario para editar un reporte operativo.
     */
    public function edit(ReportesOperativos $reportesoperativos)
    {
        return view('reportes.edit', compact('reportesoperativos'));
    }

    /**
     * Actualizar un reporte operativo en almacenamiento.
     */
    public function update(Request $request, ReportesOperativos $reportesoperativos)
    {
        $reportesoperativos->update($request->all());
        return redirect()->route('reportes.index');
    }

    /**
     * Eliminar un reporte operativo específico.
     */
    public function destroy(ReportesOperativos $reportesoperativos)
    {
        $reportesoperativos->delete();
        return back();
    }

    /**
     * Descargar el archivo PDF de un reporte operativo específico.
     */
    public function downloadPdf(ReportesOperativos $reporte)
    {
        $filePath = storage_path('app/public/' . $reporte->pdf_document);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->route('reportes.index');
    }
}
