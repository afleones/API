<?php

namespace App\Http\Controllers;

use App\Models\womenhealth;
use Illuminate\Http\Request;

class womenhealthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $womenhealth = womenhealth::selectRaw("
        id,
        weight,
        size,
        imc,
        systolicPressure,
        diastolicPressure,
        cytologyCervical,
        mammographyLast,
        useMethods,
        teenagerWithHistory,
        backgroundMal,
        backgroundAbortions,
        backgroundGynecological,
        chronicDiseases,
        intergenicPeriod,
        backgroundVIHITS,
        backgroundNewborn,
        antecedentPregnancy,
        womanInPuerperio,
        violenceGender,
        tocedorChronic,
        tripEndemicZones,
        userId,
        personaId,
        viviendaId,
        created_at,
        updated_at")->get();
        return $womenhealth;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $womenhealth = new womenhealth();

        $womenhealth->peso = $data['peso'] ?? '';
        $womenhealth->talla = $data['talla'] ?? '';
        $womenhealth->imc = $data['imc'] ?? '';
        $womenhealth->presionSistolica = $data['presionSistolica'] ?? '';
        $womenhealth->presionDiastolica = $data['presionDiastolica'] ?? '';
        $womenhealth->citologiaCervical = $data['citologiaCervical'] ?? '';
        $womenhealth->mamografiaReciente = $data['mamografiaReciente'] ?? '';
        $womenhealth->metodosAnticonceptivos = $data['metodosAnticonceptivos'] ?? '';
        $womenhealth->adolescenteConAntecedentes = $data['adolescenteConAntecedentes'] ?? '';
        $womenhealth->antecedentesMal = $data['antecedentesMal'] ?? '';
        $womenhealth->antecedentesAbortos = $data['antecedentesAbortos'] ?? '';
        $womenhealth->antecedentesGinecologicos = $data['antecedentesGinecologicos'] ?? '';
        $womenhealth->enfermedadesCronicas = $data['enfermedadesCronicas'] ?? '';
        $womenhealth->periodoIntergenico = $data['periodoIntergenico'] ?? '';
        $womenhealth->antecedentesVIHITS = $data['antecedentesVIHITS'] ?? '';
        $womenhealth->antecedentesRecienNacido = $data['antecedentesRecienNacido'] ?? '';
        $womenhealth->antecedentesEmbarazo = $data['antecedentesEmbarazo'] ?? '';
        $womenhealth->mujerEnPuerperio = $data['mujerEnPuerperio'] ?? '';
        $womenhealth->violenciaGenero = $data['violenciaGenero'] ?? '';
        $womenhealth->tocedorCronico = $data['tocedorCronico'] ?? '';
        $womenhealth->zonasEndemicasViaje = $data['zonasEndemicasViaje'] ?? '';
                

        // Guardamos el objeto en la base de datos
        $womenhealth->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, womenhealth $womenhealth)
    {
        //$data = $request->json()->all();
        $data = $request->all(); 
        //var_dump($data);exit();
        $userid = $data['userId'];
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        

        $womenhealth = womenhealth::where('userId', $userid)
                         ->where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->orWhere('id', $data['id']);
                            }
                            if (isset($data['personaId'])) {
                                $query->orWhere('personaId', $data['personaId']);
                            }
                            //$query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
                         })
                         ->get();

       

        $dataArray = array($womenhealth);                 
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $data = $request->json()->all();
        $id = $data['id'];
        $userid = $data['userId'];
        $personid = $data['personaId'];
        $peso= $data['peso'] ?? '';
        $talla= $data['talla'] ?? '';
        $imc= $data['imc'] ?? '';
        $tensionArterial= $data['tensionArterial'] ?? '';
        $citologiaCervicoUterina= $data['citologiaCervicoUterina'] ?? '';
        $mamografiaUltimos5Anios= $data['mamografiaUltimos5Anios'] ?? '';
        $usoMetodosAnticonceptivos= $data['usoMetodosAnticonceptivos'] ?? '';
        $adolecenteConAntecedenteEmbarazo= $data['adolecenteConAntecedenteEmbarazo'] ?? '';
        $antecedentesMalformacionesFamiliares= $data['antecedentesMalformacionesFamiliares'] ?? '';
        $antecedentesAbortosEspontaneos= $data['antecedentesAbortosEspontaneos'] ?? '';
        $antecedenteCirugiaGinecologica= $data['antecedenteCirugiaGinecologica'] ?? '';
        $enfermedadesCronicas= $data['enfermedadesCronicas'] ?? '';
        $periodoIntergenesico= $data['periodoIntergenesico'] ?? '';
        $antecedenteVIHITS= $data['antecedenteVIHITS'] ?? '';
        $antecedenteRecienNacidoMacrosomicoOBajoPeso= $data['antecedenteRecienNacidoMacrosomicoOBajoPeso'] ?? '';
        $antecedenteEmbarazoMultiple= $data['antecedenteEmbarazoMultiple'] ?? '';
        $mujerEnPuerperioSinMetodo= $data['mujerEnPuerperioSinMetodo'] ?? '';
        $violenciaGeneroFeminicidio= $data['violenciaGeneroFeminicidio'] ?? '';
        $tocedorCronicoMas14Dias2= $data['tocedorCronicoMas14Dias2'] ?? '';
        $viajeZonasEndemicasUltimos15Dias2= $data['viajeZonasEndemicasUltimos15Dias2'] ?? '';
        
        $tabla = womenhealth::where('id', $id)
                   
        ->firstOrFail();
        $tabla->peso= $peso;
        $tabla->talla= $talla;
        $tabla->imc= $imc;
        $tabla->tensionArterial= $tensionArterial;
        $tabla->citologiaCervicoUterina= $citologiaCervicoUterina;
        $tabla->mamografiaUltimos5Anios= $mamografiaUltimos5Anios;
        $tabla->usoMetodosAnticonceptivos= $usoMetodosAnticonceptivos;
        $tabla->adolecenteConAntecedenteEmbarazo= $adolecenteConAntecedenteEmbarazo;
        $tabla->antecedentesMalformacionesFamiliares= $antecedentesMalformacionesFamiliares;
        $tabla->antecedentesAbortosEspontaneos= $antecedentesAbortosEspontaneos;
        $tabla->antecedenteCirugiaGinecologica= $antecedenteCirugiaGinecologica;
        $tabla->enfermedadesCronicas= $enfermedadesCronicas;
        $tabla->periodoIntergenesico= $periodoIntergenesico;
        $tabla->antecedenteVIHITS= $antecedenteVIHITS;
        $tabla->antecedenteRecienNacidoMacrosomicoOBajoPeso= $antecedenteRecienNacidoMacrosomicoOBajoPeso;
        $tabla->antecedenteEmbarazoMultiple= $antecedenteEmbarazoMultiple;
        $tabla->mujerEnPuerperioSinMetodo= $mujerEnPuerperioSinMetodo;
        $tabla->violenciaGeneroFeminicidio= $violenciaGeneroFeminicidio;
        $tabla->tocedorCronicoMas14Dias2= $tocedorCronicoMas14Dias2;
        $tabla->viajeZonasEndemicasUltimos15Dias2= $viajeZonasEndemicasUltimos15Dias2;
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
        $userid = $data['userId'];
        $personaid = $data['personaId'];
        womenhealth::where('id', $id)->where('id', $id)
                                     ->where('userId', $userid)
                                     ->where('personaId', $personaid)
                                     ->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
