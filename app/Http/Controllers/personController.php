<?php

namespace App\Http\Controllers;

use App\Models\person;
use Illuminate\Http\Request;

class personController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = DB::table('person')->select(
            'id',
            'rol_familiar',
            'primer_nombre',
            'segundo_nombre',
            'primer_apellido',
            'segundo_apellido',
            'tipo_documento',
            'numero_documento',
            'fecha_nacimiento',
            'edad',
            'sexo',
            'identidad_genero',
            'telefono_familiar',
            'nivel_escolaridad',
            'aporta_ingresos',
            'tipo_afiliacion',
            'grupo_atencion_familiar',
            'habla_creole',
            'vacunas_covid',
            'dosis_vacuna',
            'consumo_sustancias',
            'tipo_sustancias',
            'persona_recibe_visita',
            'cursos_vida_integrantes',
            'ocupacion_integrantes',
            'situacion_discapacidad',
            'tipo_discapacidad',
            'atencion_integral',
            'vinculacion_sgsss',
            'percepcion_funcionalidad',
            'cuidador_principal',
            'escala_zarit',
            'userid',
            'viviendaid'
        )->get();
    
        $formattedPeople = [];
    
        foreach ($people as $person) {
            $formattedPerson = (object)[
                'id' => $person->id,
                'rolFamiliar' => $person->rol_familiar,
                'primerNombre' => $person->primer_nombre,
                'segundoNombre' => $person->segundo_nombre,
                'primerApellido' => $person->primer_apellido,
                'segundoApellido' => $person->segundo_apellido,
                'tipoDocumento' => $person->tipo_documento,
                'numeroDocumento' => $person->numero_documento,
                'fechaNacimiento' => $person->fecha_nacimiento,
                'edad' => $person->edad,
                'sexo' => $person->sexo,
                'identidadGenero' => $person->identidad_genero,
                'telefonoFamiliar' => $person->telefono_familiar,
                'nivelEscolaridad' => $person->nivel_escolaridad,
                'aportaIngresos' => $person->aporta_ingresos,
                'tipoAfiliacion' => $person->tipo_afiliacion,
                'grupoAtencionFamiliar' => $person->grupo_atencion_familiar,
                'hablaCreole' => $person->habla_creole,
                'vacunasCovid' => $person->vacunas_covid,
                'dosisVacuna' => $person->dosis_vacuna,
                'consumoSustancias' => $person->consumo_sustancias,
                'tipoSustancias' => $person->tipo_sustancias,
                'personaRecibeVisita' => $person->persona_recibe_visita,
                'cursosVidaIntegrantes' => $person->cursos_vida_integrantes,
                'ocupacionIntegrantes' => $person->ocupacion_integrantes,
                'situacionDiscapacidad' => $person->situacion_discapacidad,
                'tipoDiscapacidad' => $person->tipo_discapacidad,
                'atencionIntegral' => $person->atencion_integral,
                'vinculacionSgsss' => $person->vinculacion_sgsss,
                'percepcionFuncionalidad' => $person->percepcion_funcionalidad,
                'cuidadorPrincipal' => $person->cuidador_principal,
                'escalaZarit' => $person->escala_zarit,
                'userId' => $person->userid,
                'viviendaId' => $person->viviendaid,
            ];
    
            $formattedPeople[] = $formattedPerson;
        }
    
        return $formattedPeople;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $person = new person();

        $person->rol_familiar = $data['rol_familiar'] ?? '';
        
        $person->primer_nombre = $data['primer_nombre'] ?? '';
        $person->segundo_nombre = $data['segundo_nombre'] ?? '';
        $person->primer_apellido = $data['primer_apellido'] ?? '';
        $person->segundo_apellido = $data['segundo_apellido'] ?? '';
        $person->tipo_documento = $data['tipo_documento'] ?? '';
        $person->numero_documento = $data['numero_documento'] ?? '';
        $person->fecha_nacimiento = $data['fecha_nacimiento'] ?? '';
        $person->edad = $data['edad'] ?? '';
        $person->sexo = $data['sexo'] ?? '';
        $person->identidad_genero = $data['identidad_genero'] ?? '';
        $person->telefono_familiar = $data['telefono_familiar'] ?? '';
        $person->nivel_escolaridad = $data['nivel_escolaridad'] ?? '';
        $person->aporta_ingresos = $data['aporta_ingresos'] ?? '';
        $person->tipo_afiliacion = $data['tipo_afiliacion'] ?? '';
        $person->grupo_atencion_familiar = $data['grupo_atencion_familiar'] ?? '';
        $person->habla_creole = $data['habla_creole'] ?? '';
        $person->vacunas_covid = $data['vacunas_covid'] ?? '';
        $person->dosis_vacuna = $data['dosis_vacuna'] ?? '';
        $person->consumo_sustancias = $data['consumo_sustancias'] ?? '';
        $person->tipo_sustancias = $data['tipo_sustancias'] ?? '';
        $person->persona_recibe_visita = $data['persona_recibe_visita'] ?? '';
        $person->cursos_vida_integrantes = $data['cursos_vida_integrantes'] ?? '';
        $person->ocupacion_integrantes = $data['ocupacion_integrantes'] ?? '';
        $person->situacion_discapacidad = $data['situacion_discapacidad'] ?? '';
        $person->tipo_discapacidad = $data['tipo_discapacidad'] ?? '';
        $person->atencion_integral = $data['atencion_integral'] ?? '';
        $person->vinculacion_sgsss = $data['vinculacion_sgsss'] ?? '';
        $person->percepcion_funcionalidad = $data['percepcion_funcionalidad'] ?? '';
        $person->cuidador_principal = $data['cuidador_principal: false,'] ?? '';
        $person->escala_zarit = $data['escala_zarit'] ?? '';
        $person->userid = $data['userid'] ?? '';
        $person->viviendaid = $data['viviendaid'] ?? '';
        

        
        // Guardamos el objeto en la base de datos
        $person->save();
    
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente']);



    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, person $person)
    {
        //$data = $request->json()->all();
        $data = $request->all(); 

        //var_dump($data);exit();
        $userid = $data['userid'];
        //$fecha1 = $data['fecha1'];
        //$fecha2 = $data['fecha2'];
        //$viviendaid = $data['viviendaid'];
        

        $person = person::where('userid', $userid)
                         ->where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->orWhere('id', $data['id']);
                            }
                            if (isset($data['viviendaid'])) {
                                $query->orWhere('viviendaid', $data['viviendaid']);
                            }
                            //$query->whereBetween(\DB::raw('DATE(created_at)'), [$fecha1, $fecha2]);
                         })
                         ->get();

       

        $dataArray = array($person);                 
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
        $persona_recibe_visita = $data['persona_recibe_visita'];
        $cursos_vida_integrantes = $data['cursos_vida_integrantes'];
        $ocupacion_integrantes = $data['ocupacion_integrantes'];
        $situacion_discapacidad = $data['situacion_discapacidad'];
        $tipo_discapacidad = $data['tipo_discapacidad'];
        $atencion_integral = $data['atencion_integral'];
        $vinculacion_sgsss = $data['vinculacion_sgsss'];
        $percepcion_funcionalidad = $data['percepcion_funcionalidad'];
        $cuidador_principal = $data['cuidador_principal: false,'];
        $escala_zarit = $data['escala_zarit'];
        $userid = $data['userid'];
        $personid = $data['personid'];


        $tabla = person::where('id', $id)
                   ->where('userid', $userid)
                   ->where('personid', $personid)
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
        $personid = $data['personid'];
        person::where('id', $id)->where('id', $id)
                                ->where('userid', $userid)
                                ->where('personid', $personid)
                                ->delete();
    
        return response()->json(['message' => 'Dato borrado correctamente']);

    }
}
