<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permisos = Permission::all();
        //debera retornar a la vista donde vas a reflejar todos los permisos 
        return view('admin.permisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Retorna la vista para crear un nuevo permiso
         return view('admin.permisos.crear_permiso');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $permission = Permission::create(['name' => $request]);
        $permission = Permission::create(['name' => $request->input('name')]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);
        return view('admin.evaluaciones.mostrar_permiso', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
        return view('admin.evaluaciones.editar_permiso', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //ANALIZA AMBOS, SI NO FUNCIONA LA FORMA DOS CON FIND, USA ESTE
        // $permission = Permission::findOrFail($id);
        // $permission->update(['name' => $request->input('nombreDelInput')]);

        //forma dos
        $permission = Permission::find($id);
        $permission->name = $request->input('edit');
        $permission->save();


        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //FORMA UNO
        $permission = Permission::find($id);
        $permission->delete();

        //DOS
        // DB::table("roles")->where('id',$id)->delete();
        return back();

    }
}
