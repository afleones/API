<?php

namespace App\Http\Controllers;

use App\Models\childhood;
use Illuminate\Http\Request;

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
    public function show(Request $request, childhood $childhood)
    {
        //$data = $request->json()->all();
        $data = $request->all(); 

        //var_dump($data);exit();
        $userid = $data['userId'];
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        //$viviendaid = $data['viviendaid'];
        

        $childhood = childhood::where('userId', $userid)
                         ->where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->Where('id', $data['id']);
                            }
                            if (isset($data['userId'])) {
                                $query->Where('userId', $data['userId']);
                            }
                            if (isset($data['viviendaId'])) {
                                $query->Where('viviendaId', $data['viviendaId']);
                            }
                            //$query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
                         })
                         ->get();

       

        $dataArray = array($childhood);                 
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
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


        $tabla = childhood::where('id', $id)
                   ->where('userid', $userid)
                   ->where('childhoodid', $childhoodid)
                   ->firstOrFail();

        $tabla->rol_familiar = $rol_familiar;
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