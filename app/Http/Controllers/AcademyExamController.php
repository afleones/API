<?php

namespace App\Http\Controllers;

use App\Models\AcademyExam;
use App\Models\AcademyExamOptionAnswer;
use App\Models\AcademyExamQuestion;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AcademyExamController extends Controller
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function insertExam(Request $request) {
        $data = json_decode($request->getContent(), true);
    
        DB::transaction(function () use ($data) {
            foreach ($data as $examenData) {
                $examen = new AcademyExam();
                $examen->Title = $examenData['tituloExamen'];
                $examen->save();
    
                foreach ($examenData['preguntas'] as $preguntaData) {
                    $pregunta = new AcademyExamQuestion();
                    $pregunta->Exam_id = $examen->Id;
                    $pregunta->Statement = $preguntaData['titulo'];
                    $pregunta->save();
    
                    foreach ($preguntaData['opciones'] as $opcionData) {
                        $opcion = new AcademyExamOptionAnswer();
                        $opcion->Question_id = $pregunta->Id;
                        $opcion->Option_text = $opcionData['texto'];
                        $opcion->Correct = $opcionData['correcta'];
                        $opcion->save();
                    }
                }
            }
        });
    
        return response()->json(['message' => 'Datos insertados correctamente']);
    }


    public function showExams(Request $request) {
        $data = $request->all(); 

        $examenes = AcademyExam::
                                where(function($query) use ($data) {  
                                    if (isset($data['Category.Id'])) {
                                        $query->Where('Category.Id', $data['Id']);
                                    }
                                    if (isset($data['Author'])) {
                                        $query->Where('Author', $data['Author']);
                                    }
                                    if (isset($data['State'])) {
                                        $query->Where('State', $data['State']);
                                    }

                                })

                                ->selectRaw('Id,Title')

                         
                                ->get();


                                $payload = []; // Inicializa el arreglo de resultados

                                foreach ($examenes as $examen) {

                                    $preguntas = AcademyExamQuestion:: /*join('maite_backend.users', 'users.id', '=', 'Course.Author')
                                                            ->*/where('Exam_id', $examen->Id)->get();
                                    $preguntasData = [];

                                    foreach ($preguntas as $pregunta) {

                                        $respuestas = AcademyExamOptionAnswer::/*join('maite_backend.users', 'users.id', '=', 'Class.Author')
                                                              ->*/where('Question_id', $pregunta->Id)
                                                              ->selectRaw('Id,Question_id,Option_text,Correct,created_at,updated_at')
                                                              ->get();

                                                              $respuestasData=[];
                                                                    foreach ($respuestas as $respuesta) {

                                                                        $respuestasData[] =[
                                                                            'Id' => $respuesta->Id,
                                                                            //'Question_id' => $respuesta->Question_id,
                                                                            'texto' => $respuesta->Option_text,
                                                                            'Correcta' => $respuesta->Correct,
                                                                            /*'created_at' => $respuesta->created_at,
                                                                            'updated_at' => $respuesta->updated_at,*/
                                                                        ];
                                                                    }

                                            $preguntasData[] = [
                                                'Id' => $pregunta->Id,
                                                //'Exam_id' => $pregunta->Exam_id,
                                                'titulo' => $pregunta->Statement,
                                                /*'created_at' => $pregunta->created_at,
                                                'updated_at' => $pregunta->updated_at,*/
                                                'opciones' => $respuestasData
                                                
                                            ];
                                    }


                                    $payload[] = [
                                        'Id' => $examen->Id,
                                        'tituloExamen' => $examen->Title,
                                        'preguntas' => $preguntasData
                                    ];


                                }

                                return $payload;

    }


    public function updateExam(Request $request) {
        $data = json_decode($request->getContent(), true);
    
        DB::transaction(function () use ($data) {
            $examenId = $data['Id'];
    
            // Actualizar el título del examen
            AcademyExam::where('id', $examenId)
                ->update([
                    'Title' => $data['tituloExamen']
                ]);
    
            foreach ($data['preguntas'] as $preguntaData) {
                $preguntaId = $preguntaData['Id'];
    
                AcademyExamQuestion::where('id', $preguntaId)
                    ->update([
                        'Statement' => $preguntaData['titulo']
                    ]);
    
                foreach ($preguntaData['opciones'] as $opcionData) {
                    $opcionId = $opcionData['Id'];
    
                    AcademyExamOptionAnswer::where('id', $opcionId)
                        ->update([
                            'Option_text' => $opcionData['texto'],
                            'Correct' => $opcionData['Correcta']
                        ]);
                }
            }
        });
    
        return response()->json(['message' => 'Datos actualizados correctamente']);
    }



}
