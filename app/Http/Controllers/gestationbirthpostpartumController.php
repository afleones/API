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
        $gestationbirthpostpartum = new gestationbirthpostpartum();

        $gestationbirthpostpartum->rol_familiar = $data['rol_familiar'];

        // Guardamos el objeto en la base de datos
        $gestationbirthpostpartum->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);



    }

    /**
     * Display the specified resource.
     */
    public function show(gestationbirthpostpartum $gestationbirthpostpartum)
    {
        //
        $gestationbirthpostpartum = gestationbirthpostpartum::selectRaw("id,
        rol_familiar,
        primer_nombre,
        segundo_nombre,
        primer_apellido,
        segundo_apellido,
        tipo_documento,
        numero_documento,
        fecha_nacimiento,
        edad,
        sexo,
        identidad_genero,
        telefono_familiar,
        nivel_escolaridad,
        aporta_ingresos,
        tipo_afiliacion,
        grupo_atencion_familiar,
        habla_creole,
        vacunas_covid,
        dosis_vacuna,
        consumo_sustancias,
        tipo_sustancias,
        gestationbirthpostpartum_recibe_visita,
        cursos_vida_integrantes,
        ocupacion_integrantes,
        situacion_discapacidad,
        tipo_discapacidad,
        atencion_integral,
        vinculacion_sgsss,
        percepcion_funcionalidad,
        cuidador_principal,
        escala_zarit
        ")->get();
        return $gestationbirthpostpartum;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $id = $data['id'];
        
        $rol_familiar = $data['rol_familiar'];
        
        /*
        
       
        $primer_nombre = $data['primer_nombre'];
        $segundo_nombre = $data['segundo_nombre'];
        $primer_apellido = $data['primer_apellido'];
        $segundo_apellido = $data['segundo_apellido'];
        $tipo_documento = $data['tipo_documento'];
        $numero_documento = $data['numero_documento'];
        $fecha_nacimiento = $data['fecha_nacimiento'];
        $edad = $data['edad'];
        $sexo = $data['sexo'];
        $identidad_genero = $data['identidad_genero'];
        $telefono_familiar = $data['telefono_familiar'];
        $nivel_escolaridad = $data['nivel_escolaridad'];
        $aporta_ingresos = $data['aporta_ingresos'];
        $tipo_afiliacion = $data['tipo_afiliacion'];
        $grupo_atencion_familiar = $data['grupo_atencion_familiar'];
        $habla_creole = $data['habla_creole'];
        $vacunas_covid = $data['vacunas_covid'];
        $dosis_vacuna = $data['dosis_vacuna'];
        $consumo_sustancias = $data['consumo_sustancias'];
        $tipo_sustancias = $data['tipo_sustancias'];
        $gestationbirthpostpartum_recibe_visita = $data['gestationbirthpostpartum_recibe_visita'];
        $cursos_vida_integrantes = $data['cursos_vida_integrantes'];
        $ocupacion_integrantes = $data['ocupacion_integrantes'];
        $situacion_discapacidad = $data['situacion_discapacidad'];
        $tipo_discapacidad = $data['tipo_discapacidad'];
        $atencion_integral = $data['atencion_integral'];
        $vinculacion_sgsss = $data['vinculacion_sgsss'];
        $percepcion_funcionalidad = $data['percepcion_funcionalidad'];
        $cuidador_principal = $data['cuidador_principal: false,'];
        $escala_zarit = $data['escala_zarit'];
*/

        $tabla = gestationbirthpostpartum::where('id', $id)
                   
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
        gestationbirthpostpartum::where('id', $id)->where('id', $id)->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
