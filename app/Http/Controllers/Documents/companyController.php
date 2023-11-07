<?php

namespace App\Http\controllers\Documents;

use App\Http\Controllers\Controller;
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
    public function update(Request $request, $id, $userId)
    {
        $data = $request->all();
    
        // Encuentra el registro que deseas actualizar basado en los parámetros de consulta
        $company = Company::where('id', $id)
            ->where('userId', $userId)
            ->first();
    
        // Verifica si se encontró el registro
        if (!$company) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    
        // Actualiza los campos con los valores proporcionados en los datos
        $company->nitCode = $data['nitCode'];
        $company->businessName = $data['businessName'];
        $company->address = $data['address'];
        $company->telephoneType = $data['telephoneType'];
        $company->telephone = $data['telephone'];
        $company->email = $data['email'];
        $company->responsible = $data['responsible'];
        $company->logo = $data['logo'];
    
        // Guarda los cambios en la base de datos
        $company->save();
    
        return response()->json(['message' => 'Registro actualizado con éxito']);
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
