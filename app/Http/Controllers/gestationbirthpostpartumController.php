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
        $gestationbirthpostpartum->viviendaId = $data['viviendaId'];
                
        // Guardamos el objeto en la base de datos
        $gestationbirthpostpartum->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);



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
            isset($data['userId']) &&
            isset($data['personaId']) &&
            isset($data['viviendaId'])
        ) {
            // Realiza una consulta en la base de datos para encontrar una coincidencia
            $result = DB::table('maite000003.gestationBirthPostpartum')
                ->where([
                    ['userId', '=', $data['userId']],
                    ['personaId', '=', $data['personaId']],
                    ['viviendaId', '=', $data['viviendaId']]
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
