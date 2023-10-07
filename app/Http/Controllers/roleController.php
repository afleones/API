<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $role = new role();

        // Asignamos los datos a las propiedades del objeto
        $role->namerole= $data['nameRole'];
        $role->userId= $data['userId'];
        // Guardamos el objeto en la base de datos
        $role->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'role inserted correctly']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, role $role)
    {
        //$data = $request->json()->all();  recibe por raw
        $data = $request->all();   //recibe por json
        //var_dump($data);exit();
        $userid = $data['userId'];
        $fecha1 = $data['fecha1'];
        $fecha2 = $data['fecha2'];
                
        
        $role = role::where('userId', $userid)->where(function($query) use ($fecha1, $fecha2, $data) {
            if (isset($data['id'])) {
                $query->orWhere('id', $data['id']);
            }
            // if (isset($data['territorio'])) {
            // $query->orWhere('territorio', $data['territorio']);
            // }
            $query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
            })->get();     
        
        //$dataArray = array($role);
        $dataArray = ($role);   //CORRECCION DE MOSTREO DE EMPRESA 2023-10-06      OTRA VEZ                                                 
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];  
        $namerole = $data['nameRole'];
        $tabla = role::where('id', $id)->firstOrFail();
        $tabla->namerole = $namerole;
        $tabla->save();

        // Puedes retornar una respuesta o redireccionar a otra página
        return response()->json(['message' => 'Datos Actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->json()->all();
        //var_dump($data);exit();
        $id = $data['id'];
        role::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
