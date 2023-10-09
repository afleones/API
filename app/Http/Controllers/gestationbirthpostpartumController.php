<?php

namespace App\Http\Controllers;

use App\Models\gestationbirthpostpartum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class gestationbirthpostpartumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gestationbirthpostpartum = gestationbirthpostpartum::selectRaw("
        id,
        weight,
        size,
        imc,
        systolicPressure,
        diastolicPressure,
        pregnantControlled,
        pregnantWeekControl,
        pregnantExam,
        pregnantDisease,
        pregnantScheme,
        pregnantNon,
        pregnantEthnic,
        tocedorChronic,
        tripEndemic,
        userId,
        personaId,
        viviendaId")->get();
        return $gestationbirthpostpartum;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $gestationbirthpostpartum = new gestationbirthpostpartum();

        $gestationbirthpostpartum->weight = $data['weight'];
        $gestationbirthpostpartum->size = $data['size'];
        $gestationbirthpostpartum->imc = $data['imc'];
        $gestationbirthpostpartum->systolicPressure = $data['systolicPressure'];
        $gestationbirthpostpartum->diastolicPressure = $data['diastolicPressure'];
        $gestationbirthpostpartum->pregnantControlled = $data['pregnantControlled'];
        $gestationbirthpostpartum->pregnantWeekControl = $data['pregnantWeekControl'];
        $gestationbirthpostpartum->pregnantExam = $data['pregnantExam'];
        $gestationbirthpostpartum->pregnantDisease = $data['pregnantDisease'];
        $gestationbirthpostpartum->pregnantScheme = $data['pregnantScheme'];
        $gestationbirthpostpartum->pregnantNon = $data['pregnantNon'];
        $gestationbirthpostpartum->pregnantEthnic = $data['pregnantEthnic'];
        $gestationbirthpostpartum->tocedorChronic = $data['tocedorChronic'];
        $gestationbirthpostpartum->tripEndemic = $data['tripEndemic'];
        $gestationbirthpostpartum->userId = $data['userId'];
        $gestationbirthpostpartum->personaId = $data['personaId'];
        //Hacer el campo "viviendaId" nullable
        $gestationbirthpostpartum->viviendaId = $data['viviendaId'] ?? 0; // Usamos operador null coalesce
                
        // Guardamos el objeto en la base de datos
        $gestationbirthpostpartum->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);



    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,gestationbirthpostpartum $gestationbirthpostpartum )
    {
        $data = $request->all(); 
        $userId = $data['userId'];

        $gestationbirthpostpartum = gestationbirthpostpartum::where('userId', $userId)->where(function($query) use ($data) {  
            if (isset($data['id'])) {
                $query->Where('id', $data['id']);
            }
            if (isset($data['personaId'])) {
                $query->Where('personaId', $data['personaId']);
            }
            if (isset($data['viviendaId'])) {
                $query->Where('viviendaId', $data['viviendaId']);
            }
        })->get();

        $dataArray = $gestationbirthpostpartum;             
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId, $personaId, $viviendaId)
    {
        $data = $request->all();
    
        // Encuentra el registro que deseas actualizar basado en los criterios de consulta
        $gestationbirthpostpartum = gestationbirthpostpartum::where('userId', $userId)
            ->where('personaId', $personaId)
            ->where('viviendaId', $viviendaId)
            ->first();
    
        // Verifica si se encontró el registro
        if (!$gestationbirthpostpartum) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $gestationbirthpostpartum->weight = $data['weight'];
        $gestationbirthpostpartum->size = $data['size'];
        $gestationbirthpostpartum->imc = $data['imc'];
        $gestationbirthpostpartum->systolicPressure = $data['systolicPressure'];
        $gestationbirthpostpartum->diastolicPressure = $data['diastolicPressure'];
        $gestationbirthpostpartum->pregnantControlled = $data['pregnantControlled'];
        $gestationbirthpostpartum->pregnantWeekControl = $data['pregnantWeekControl'];
        $gestationbirthpostpartum->pregnantExam = $data['pregnantExam'];
        $gestationbirthpostpartum->pregnantDisease = $data['pregnantDisease'];
        $gestationbirthpostpartum->pregnantScheme = $data['pregnantScheme'];
        $gestationbirthpostpartum->pregnantNon = $data['pregnantNon'];
        $gestationbirthpostpartum->pregnantEthnic = $data['pregnantEthnic'];
        $gestationbirthpostpartum->tocedorChronic = $data['tocedorChronic'];
        $gestationbirthpostpartum->tripEndemic = $data['tripEndemic'];
        $gestationbirthpostpartum->userId = $data['userId'];
        $gestationbirthpostpartum->personaId = $data['personaId'];
        $gestationbirthpostpartum->viviendaId = $data['viviendaId'];

        // Guarda los cambios en la base de datos
        $gestationbirthpostpartum->save();
    
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
        gestationbirthpostpartum::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
