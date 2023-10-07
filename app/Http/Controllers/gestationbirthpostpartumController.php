<?php

namespace App\Http\Controllers;

use App\Models\gestationbirthpostpartum;
use Illuminate\Http\Request;

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
        $gestationbirthpostpartum->viviendaId = $data['viviendaId'];
                
        // Guardamos el objeto en la base de datos
        $gestationbirthpostpartum->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);



    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, gestationbirthpostpartum $gestationbirthpostpartum)
    {
        //$data = $request->json()->all();
        $data = $request->all(); 
        //var_dump($data);exit();
        $userid = $data['userId'];
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        //$viviendaid = $data['viviendaid'];
        

        $gestationbirthpostpartum = gestationbirthpostpartum::where('userId', $userid)->where(function($query) use ($data) {  
            if (isset($data['id'])) {
            $query->orWhere('id', $data['id']);
            }
            if (isset($data['viviendaId'])) {
                $query->orWhere('viviendaId', $data['viviendaId']);
            }
            //$query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
             })->get();

       

        //$dataArray = array($gestationbirthpostpartum);     
        $dataArray = $gestationbirthpostpartum;             
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
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
        $tabla = gestationbirthpostpartum::where('id', $id) ->firstOrFail();
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
        gestationbirthpostpartum::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
