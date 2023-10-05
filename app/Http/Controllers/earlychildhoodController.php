<?php

namespace App\Http\Controllers;

use App\Models\earlychildhood;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class earlychildhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $earlychildhood = earlychildhood::selectRaw("id,
        weight,
        size,
        headCircunference,
        gillPerimeter,
        perimeterWaist,
        perimeterHip,
        systolicPressure,
        diastolicPressure,
        antecedentPrematurity,
        congenitalAnomaly,
        consumptionSubstances,
        breastfeeding,
        chronicCondition,
        disability,
        promotionHealth,
        completeVaccination,
        deworming,
        oralHygiene,
        childDevelopment,
        signSera,
        ancestralMedicine,
        signSera2,
        victimization,
        malnutrition,
        overweightObesity,
        dangerDeath,
        nutritionalProblems,
        dresserChronic,
        tripZonesEndemic,
        userId,
        personaId,
        viviendaId,
        created_at
        updated_at")->get();
        return $earlychildhood;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // $validatedData = $request->validate($rules);
    
        // Creamos un nuevo objeto del modelo
        $earlychildhood = new earlychildhood();
        $earlychildhood->weight = $data['weight'];
        $earlychildhood->size = $data['size'];
        $earlychildhood->headCircunference = $data['headCircunference'];
        $earlychildhood->gillPerimeter = $data['gillPerimeter'];
        $earlychildhood->perimeterWaist = $data['perimeterWaist'];
        $earlychildhood->perimeterHip = $data['perimeterHip'];
        $earlychildhood->systolicPressure = $data['systolicPressure'];
        $earlychildhood->diastolicPressure = $data['diastolicPressure'];
        $earlychildhood->antecedentPrematurity = $data['antecedentPrematurity'];
        $earlychildhood->congenitalAnomaly = $data['congenitalAnomaly'];
        $earlychildhood->consumptionSubstances = $data['consumptionSubstances'];
        $earlychildhood->breastfeeding = $data['breastfeeding'];
        $earlychildhood->chronicCondition = $data['chronicCondition'];
        $earlychildhood->disability = $data['disability'];
        $earlychildhood->promotionHealth = $data['promotionHealth'];
        $earlychildhood->completeVaccination = $data['completeVaccination'];
        $earlychildhood->deworming = $data['deworming'];
        $earlychildhood->oralHygiene = $data['oralHygiene'];
        $earlychildhood->childDevelopment = $data['childDevelopment'];
        $earlychildhood->signSera = $data['signSera'];
        $earlychildhood->ancestralMedicine = $data['ancestralMedicine'];
        $earlychildhood->signSera2 = $data['signSera2'];
        $earlychildhood->victimization = $data['victimization'];
        $earlychildhood->malnutrition = $data['malnutrition'];
        $earlychildhood->overweightObesity = $data['overweightObesity'];
        $earlychildhood->dangerDeath = $data['dangerDeath'];
        $earlychildhood->nutritionalProblems = $data['nutritionalProblems'];
        $earlychildhood->dresserChronic = $data['dresserChronic'];
        $earlychildhood->tripZonesEndemic = $data['tripZonesEndemic'];
        $earlychildhood->userId = $data['userId'];
        $earlychildhood->personaId = $data['personaId'];
        $earlychildhood->viviendaId = $data['viviendaId'];
                
        //Guardamos el objeto en la base de datos
        $earlychildhood->save();
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, earlychildhood $earlychildhood)
    {
       //$data = $request->json()->all();  recibe por raw
       $data = $request->all();   //recibe por json
        //var_dump($data);exit();
        $userid = $data['userid'];
        // $fecha1 = $data['fecha1'];
        // $fecha2 = $data['fecha2'];
        $earlychildhood = earlychildhood::where('userid', $userid)
                         ->where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->orWhere('id', $data['id']);
                            }
                            // if (isset($data['personaid'])) {
                            //     $query->orWhere('personaid', $data['personaid']);
                            // }
                            //$query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
                         })
                         ->get();
        $dataArray = array($earlychildhood);                 
        return $dataArray;
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            // Validación de datos
            $request->validate([
                'weight' => 'numeric',
                'size' => 'numeric',
                'headCircunference' => 'numeric',
                'gillPerimeter' => 'numeric',
                'perimeterWaist' => 'numeric',
                'perimeterHip' => 'numeric',
                'systolicPressure' => 'numeric',
                'diastolicPressure' => 'numeric',
                'antecedentPrematurity' => Rule::in([2, 1]), // 0 o 1 para TINYINT
                'congenitalAnomaly' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'consumptionSubstances' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'breastfeeding' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'chronicCondition' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'disability' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'promotionHealth' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'completeVaccination' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'deworming' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'oralHygiene' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'childDevelopment' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'signSera' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'ancestralMedicine' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'signSera2' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'victimization' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'malnutrition' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'overweightObesity' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'dangerDeath' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'nutritionalProblems' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'dresserChronic' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'tripZonesEndemic' => Rule::in([2, 1]), // 2 o 1 para TINYINT
                'userId' => 'numeric',
                'personaId' => 'numeric',
                'viviendaId' => 'numeric',
            ]);
        
            // Buscar el registro por ID
            $registro = earlychildhood::find($id);
        
            if (!$registro) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
        
            // Actualizar los campos
            $registro->update($request->all());
        
            return response()->json(['message' => 'Registro actualizado con éxito']);
        }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->json()->all();
        //var_dump($data);exit();
        $id = $data['personid'];
        earlychildhood::where('', $id)->where('personid', $id)->delete();   
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
