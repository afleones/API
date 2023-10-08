<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class companyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = company::selectRaw("id,
        nitCode, 
        businessName,
        address,
        telephoneType,
        telephone,
        email,
        responsible,
        logo,
        userId,
        created_at, 
        updated_at")->get();
        return $company;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $company = new company();

        // Asignamos los datos a las propiedades del objeto
        $company->nitCode = $data['nitCode'];
        $company->businessName = $data['businessName'];
        $company->address = $data['address'];
        $company->telephoneType = $data['telephoneType'];
        $company->telephone = $data['telephone'];
        $company->email = $data['email'];
        $company->responsible = $data['responsible'];
        $company->logo = $data['logo'];
        $company->userId = $data['userId'];

        // Guardamos el objeto en la base de datos
        $company->save();
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Correctly Registered Company']);

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
            isset($data['id'])
        ) {
            // Realiza una consulta en la base de datos para encontrar una coincidencia
            $result = DB::table('maite000003.company')
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
        $company->nitCode = $data['nitCode'];
        $company->businessName = $data['businessName'];
        $company->address = $data['address'];
        $company->telephoneType = $data['telephoneType'];
        $company->telephone = $data['telephone'];
        $company->email = $data['email'];
        $company->responsible = $data['responsible'];
        $company->logo = $data['logo'];
        $company->userId = $data['userId'];

        $tabla = company::where('id', $id)->firstOrFail();

        $tabla->nitCode = $data['nitCode'];
        $tabla->businessName = $data['businessName'];
        $tabla->address = $data['address'];
        $tabla->telephoneType = $data['telephoneType'];
        $tabla->telephone = $data['telephone'];
        $tabla->email = $data['email'];
        $tabla->responsible = $data['responsible'];
        $tabla->logo = $data['logo'];
        $tabla->userId = $data['userId'];

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
        weight::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
