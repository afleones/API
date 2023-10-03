<?php

namespace App\Http\Controllers;

use App\Models\communicablediseases;
use Illuminate\Http\Request;

class communicablediseasesController extends Controller
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
        //
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $communicablediseases = new communicablediseases();

        $communicablediseases->nombreCompleto = $data['nombreCompleto'];
        /*
        $communicablediseases->sexo = $data['sexo'];
        $communicablediseases->edad = $data['edad'];
        $communicablediseases->parentezco = $data['parentezco'];
        $communicablediseases->ocupacion = $data['ocupacion'];
        $communicablediseases->aportaIngresos = $data['aportaIngresos'];
        $communicablediseases->nivelEscolaridad = $data['nivelEscolaridad'];
        $communicablediseases->tipoAfiliacion = $data['tipoAfiliacion'];
        $communicablediseases->grupoAtencionEspecial = $data['grupoAtencionEspecial'];
        $communicablediseases->hablaCreole = $data['hablaCreole'];
        $communicablediseases->vacunaCovid = $data['vacunaCovid'];
        $communicablediseases->dosisVacuna = $data['dosisVacuna'];
        $communicablediseases->consumoSustancias = $data['consumoSustancias'];
        $communicablediseases->sustanciasConsumidas = $data['sustanciasConsumidas'];
*/

        // Guardamos el objeto en la base de datos
        $communicablediseases->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(communicablediseases $communicablediseases)
    {
        $communicablediseases = communicablediseases::selectRaw("id,
        nombreCompleto,
        sexo,
        edad,
        parentezco,
        ocupacion,
        aportaIngresos,
        nivelEscolaridad,
        tipoAfiliacion,
        grupoAtencionEspecial,
        hablaCreole,
        vacunaCovid,
        dosisVacuna,
        consumoSustancias,
        sustanciasConsumidas")->get();
        return $communicablediseases;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        $nombreCompleto = $data['nombreCompleto'];
        /*
        $sexo = $data['sexo'];
        $edad = $data['edad'];
        $parentezco = $data['parentezco'];
        $ocupacion = $data['ocupacion'];
        $aportaIngresos = $data['aportaIngresos'];
        $nivelEscolaridad = $data['nivelEscolaridad'];
        $tipoAfiliacion = $data['tipoAfiliacion'];
        $grupoAtencionEspecial = $data['grupoAtencionEspecial'];
        $hablaCreole = $data['hablaCreole'];
        $vacunaCovid = $data['vacunaCovid'];
        $dosisVacuna = $data['dosisVacuna'];
        $consumoSustancias = $data['consumoSustancias'];
        $sustanciasConsumidas = $data['sustanciasConsumidas'];

*/

        
        $tabla = communicablediseases::where('id', $id)
                   
        ->firstOrFail();

        $tabla->nombreCompleto = $nombreCompleto;
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
        communicablediseases::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);
    }
}
