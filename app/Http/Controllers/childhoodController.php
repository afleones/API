<?php

namespace App\Http\Controllers;

use App\Models\childhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class childhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
       $childhood = childhood::selectRaw("id,
       weight,
       size,
       headCircunference,
       gillPerimeter,
       perimeterWaist,
       perimeterHip,
       systolicPressure,
       diastolicPressure,
       congenitalAnomaly,
       consumptionSubstances,
       chronicConditions,
       disability,
       promotionHealth,
       completeVaccination,
       deworming,
       oralHygiene,
       optometryPending,
       problemsDevelopment,
       signsEda,
       signsEra,
       medicineAncestral,
       nutritionalProblems,
       malnutrition,
       overweightObesity,
       dangerDeath,
       victimization,
       unschooling,
       schoolPerformance,
       dresserChronic,
       tripZonesEndemic,
       userId,
       childhoodId,
       viviendaId,
       created_at
       updated_at")->get();
       return $childhood;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        // Creamos un nuevo objeto del modelo
        $childhood = new childhood();
        $childhood->weight = $data['weight'];
        $childhood->size = $data['size'];
        $childhood->headCircunference = $data['headCircunference'];
        $childhood->gillPerimeter = $data['gillPerimeter'];
        $childhood->perimeterWaist = $data['perimeterWaist'];
        $childhood->perimeterHip = $data['perimeterHip'];
        $childhood->systolicPressure = $data['systolicPressure'];
        $childhood->diastolicPressure = $data['diastolicPressure'];
        $childhood->congenitalAnomaly = $data['congenitalAnomaly'];
        $childhood->consumptionSubstances = $data['consumptionSubstances'];
        $childhood->chronicConditions = $data['chronicConditions'];
        $childhood->disability = $data['disability'];
        $childhood->promotionHealth = $data['promotionHealth'];
        $childhood->completeVaccination = $data['completeVaccination'];
        $childhood->deworming = $data['deworming'];
        $childhood->oralHygiene = $data['oralHygiene'];
        $childhood->optometryPending = $data['optometryPending'];
        $childhood->problemsDevelopment = $data['problemsDevelopment'];
        $childhood->signsEda = $data['signsEda'];
        $childhood->signsEra = $data['signsEra'];
        $childhood->nutritionalProblems = $data['nutritionalProblems'];
        $childhood->malnutrition = $data['malnutrition'];
        $childhood->overweightObesity = $data['overweightObesity'];
        $childhood->dangerDeath = $data['dangerDeath'];
        $childhood->victimization = $data['victimization'];
        $childhood->unschooling = $data['unschooling'];
        $childhood->schoolPerformance = $data['schoolPerformance'];
        $childhood->dresserChronic = $data['dresserChronic'];
        $childhood->tripZonesEndemic = $data['tripZonesEndemic'];
        $childhood->userId = $data['userId'];  
        $childhood->personaId = $data['personaId'];  
        $childhood->viviendaId = $data['viviendaId'];  
        $childhood->save();
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
            $result = DB::table('maite000003.childHood')
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
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $childhood->id = $data['id'];
        $childhood->weight = $data['weight'];
        $childhood->size = $data['size'];
        $childhood->headCircunference = $data['headcircunference'];
        $childhood->gillPerimeter = $data['gillperimeter'];
        $childhood->perimeterWaist = $data['perimeterwaist'];
        $childhood->perimeterHip = $data['perimeterHip'];
        $childhood->systolicPressure = $data['systolicpressure'];
        $childhood->diastolicPressure = $data['diastolicpressure'];
        $childhood->congenitalAnomaly = $data['congenitalAnomaly'];
        $childhood->consumptionSubstances = $data['consumptionSubstances'];
        $childhood->chronicConditions = $data['chronicConditions'];
        $childhood->disability = $data['disability'];
        $childhood->promotionHealth = $data['promotionHealth'];
        $childhood->completeVaccination = $data['completeVaccination'];
        $childhood->deworming = $data['deworming'];
        $childhood->oralHygiene = $data['oralHygiene'];
        $childhood->optometryPending = $data['optometryPending'];
        $childhood->problemsDevelopment = $data['problemsDevelopment'];
        $childhood->signsEda = $data['signsEda'];
        $childhood->signsEra = $data['signsEra'];
        $childhood->nutritionalProblems = $data['nutritionalProblems'];
        $childhood->malnutrition = $data['malnutrition'];
        $childhood->overweightObesity = $data['overweightobesity'];
        $childhood->dangerDeath = $data['dangerDeath'];
        $childhood->victimization = $data['victimization'];
        $childhood->unschooling = $data['unschooling'];
        $childhood->schoolPerformance = $data['schoolPerformance'];
        $childhood->dresserChronic = $data['dresserChronic'];
        $childhood->tripZonesEndemic = $data['tripZonesEndemic'];
        $childhood->userId = $data['userId'];  
        $childhood->userId = $data['personaId'];  
        $childhood->userId = $data['viviendaId'];  


        $tabla = childhood::where('id', $id)->firstOrFail();

        $tabla->weight = $data['weight'];
        $tabla->size = $data['size'];
        $tabla->headCircunference = $data['headCircunference'];
        $tabla->gillPerimeter = $data['gillPerimeter'];
        $tabla->perimeterWaist = $data['perimeterWaist'];
        $tabla->perimeterHip = $data['perimeterHip'];
        $tabla->systolicPressure = $data['systolicPressure'];
        $tabla->diastolicPressure = $data['diastolicPressure'];
        $tabla->congenitalAnomaly = $data['congenitalAnomaly'];
        $tabla->consumptionSubstances = $data['consumptionSubstances'];
        $tabla->chronicConditions = $data['chronicConditions'];
        $tabla->disability = $data['disability'];
        $tabla->promotionHealth = $data['promotionHealth'];
        $tabla->completeVaccination = $data['completeVaccination'];
        $tabla->deworming = $data['deworming'];
        $tabla->oralHygiene = $data['oralHygiene'];
        $tabla->optometryPending = $data['optometryPending'];
        $tabla->problemsDevelopment = $data['problemsDevelopment'];
        $tabla->signsEda = $data['signsEda'];
        $tabla->signsEra = $data['signsEra'];
        $tabla->nutritionalProblems = $data['nutritionalProblems'];
        $tabla->malnutrition = $data['malnutrition'];
        $tabla->overweightObesity = $data['overweightObesity'];
        $tabla->dangerDeath = $data['dangerDeath'];
        $tabla->victimization = $data['victimization'];
        $tabla->unschooling = $data['unschooling'];
        $tabla->schoolPerformance = $data['schoolPerformance'];
        $tabla->dresserChronic = $data['dresserChronic'];
        $tabla->tripZonesEndemic = $data['tripZonesEndemic'];
        $tabla->userId = $data['userId'];  
        $tabla->personaId = $data['personaId'];  
        $tabla->viviendaId = $data['viviendaId'];  
           
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
        $userid = $data['userid'];
        $childhoodid = $data['childhoodid'];
        childhood::where('id', $id)->where('id', $id)
                                ->where('userid', $userid)
                                ->where('childhoodid', $childhoodid)
                                ->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}