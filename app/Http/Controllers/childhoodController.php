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
       $childhood = childhood::selectRaw("id,
       weight,
       size,
       headcircunference,
       gillperimeter,
       perimeterwaist,
       perimeterHip,
       systolicpressure,
       diastolicpressure,
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
       overweightobesity,
       dangerDeath,
       victimization,
       unschooling,
       schoolPerformance,
       dresserChronic,
       tripZonesEndemic,
       userid,
       updated_at,
       created_at
       ")->get();
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
        $childhood->headcircunference = $data['headcircunference'];
        $childhood->gillperimeter = $data['gillperimeter'];
        $childhood->perimeterwaist = $data['perimeterwaist'];
        $childhood->perimeterHip = $data['perimeterHip'];
        $childhood->systolicpressure = $data['systolicpressure'];
        $childhood->diastolicpressure = $data['diastolicpressure'];
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
        $childhood->overweightobesity = $data['overweightobesity'];
        $childhood->dangerDeath = $data['dangerDeath'];
        $childhood->victimization = $data['victimization'];
        $childhood->unschooling = $data['unschooling'];
        $childhood->schoolPerformance = $data['schoolPerformance'];
        $childhood->dresserChronic = $data['dresserChronic'];
        $childhood->tripZonesEndemic = $data['tripZonesEndemic'];
        $childhood->userid = $data['userid'];
        // Guardamos el objeto en la base de datos
        $childhood->save();
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Formulario Registrado Correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, childhood $childhood)
    {
        $data = $request->json()->all();
        //var_dump($data);exit();
        $userid = $data['userid'];
        // $fecha1 = $data['fecha1'];
        // $fecha2 = $data['fecha2'];
        

        $childhood = childhood::where('userid', $userid)
                         ->where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->orWhere('id', $data['id']);
                            }
                            if (isset($data['personaid'])) {
                                $query->orWhere('personaid', $data['personaid']);
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
        
        $rol_familiar = $data['rol_familiar'];
        $tabla = childhood::where('id', $id)
                   
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
        childhood::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
