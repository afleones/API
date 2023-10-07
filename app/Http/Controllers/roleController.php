<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function show(Request $request)
    {
        // Accede a los datos de la solicitud POST
        $data = $request->all();
    
        // Valida que los parámetros requeridos estén presentes en la solicitud
        if (
            isset($data['useidrId'])
        ) {
            // Realiza una consulta en la base de datos para encontrar una coincidencia
            $result = DB::table('maite000003.role')
                ->where([
                    ['id', '=', $data['id']]
                ]) ->first(); // Obtén la primera coincidencia
    
            if ($result) {
                // Envía la respuesta en un arreglo
                return response()->json(['data' => [$result]], 200);
            } else {
                // Si no se encuentra una coincidencia, devuelve una respuesta de error
                return response()->json(['message' => 'No se encontraron coincidencias'], 404);
            }
            } else {
                // Si falta alguno de los parámetros requeridos, devuelve una respuesta de error
                return response()->json(['message' => 'Parámetros faltantes'], 400);
            }
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
