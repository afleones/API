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
        $womenhealth = womenhealth::selectRaw("id,
        peso,
        talla,
        imc,
        tensionArterial,
        citologiaCervicoUterina,
        mamografiaUltimos5Anios,
        usoMetodosAnticonceptivos,
        adolecenteConAntecedenteEmbarazo,
        antecedentesMalformacionesFamiliares,
        antecedentesAbortosEspontaneos,
        antecedenteCirugiaGinecologica,
        enfermedadesCronicas,
        periodoIntergenesico,
        antecedenteVIHITS,
        antecedenteRecienNacidoMacrosomicoOBajoPeso,
        antecedenteEmbarazoMultiple,
        mujerEnPuerperioSinMetodo,
        violenciaGeneroFeminicidio,
        tocedorCronicoMas14Dias2,
        viajeZonasEndemicasUltimos15Dias2,
        userid
        ")->get();
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
        $womenhealth->talla= $data['talla'] ?? '';
        $womenhealth->imc= $data['imc'] ?? '';
        $womenhealth->tensionArterial= $data['tensionArterial'] ?? '';
        $womenhealth->citologiaCervicoUterina= $data['citologiaCervicoUterina'] ?? '';
        $womenhealth->mamografiaUltimos5Anios= $data['mamografiaUltimos5Anios'] ?? '';
        $womenhealth->usoMetodosAnticonceptivos= $data['usoMetodosAnticonceptivos'] ?? '';
        $womenhealth->adolecenteConAntecedenteEmbarazo= $data['adolecenteConAntecedenteEmbarazo'] ?? '';
        $womenhealth->antecedentesMalformacionesFamiliares= $data['antecedentesMalformacionesFamiliares'] ?? '';
        $womenhealth->antecedentesAbortosEspontaneos= $data['antecedentesAbortosEspontaneos'] ?? '';
        $womenhealth->antecedenteCirugiaGinecologica= $data['antecedenteCirugiaGinecologica'] ?? '';
        $womenhealth->enfermedadesCronicas= $data['enfermedadesCronicas'] ?? '';
        $womenhealth->periodoIntergenesico= $data['periodoIntergenesico'] ?? '';
        $womenhealth->antecedenteVIHITS= $data['antecedenteVIHITS'] ?? '';
        $womenhealth->antecedenteRecienNacidoMacrosomicoOBajoPeso= $data['antecedenteRecienNacidoMacrosomicoOBajoPeso'] ?? '';
        $womenhealth->antecedenteEmbarazoMultiple= $data['antecedenteEmbarazoMultiple'] ?? '';
        $womenhealth->mujerEnPuerperioSinMetodo= $data['mujerEnPuerperioSinMetodo'] ?? '';
        $womenhealth->violenciaGeneroFeminicidio= $data['violenciaGeneroFeminicidio'] ?? '';
        $womenhealth->tocedorCronicoMas14Dias2= $data['tocedorCronicoMas14Dias2'] ?? '';
        $womenhealth->viajeZonasEndemicasUltimos15Dias2= $data['viajeZonasEndemicasUltimos15Dias2'] ?? '';
        $womenhealth->userid= $data['userid'] ?? '';
        $womenhealth->personaid= $data['personaid'] ?? '';
        

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
        $userid = $data['userid'];
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        

        $womenhealth = womenhealth::where('userid', $userid)
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

       

        //$dataArray = array($womenhealth);  
        $dataArray = ($womenhealth);                
        return $dataArray;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $data = $request->json()->all();
        $id = $data['id'];
        $userid = $data['userid'];
        $personid = $data['personid'];
        
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
        $userid = $data['userid'];
        $personaid = $data['personaid'];
        womenhealth::where('id', $id)->where('id', $id)
                                     ->where('userid', $userid)
                                     ->where('personaid', $personaid)
                                     ->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
