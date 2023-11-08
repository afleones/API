<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use App\Models\Academy\AcademyComment;
use App\Models\Academy\AcademyCommentDetail;
use App\Models\Academy\AcademyCourse;
use App\Models\Academy\AcademyClass;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class AcademyCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Comment = AcademyComment::selectRaw("id,
                                    UserId,
                                    ClassId,
                                    Comment
        ")->get();
        return $Comment;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $Comment = new AcademyComment();

        // Asignamos los datos a las propiedades del objeto
        $Comment->UserId= $data['UserId'];
        $Comment->ClassId= $data['ClassId'];
        $Comment->Comment= $data['Comment'];


        // Guardamos el objeto en la base de datos
        $Comment->save();
    
        $insertedId = $Comment->Id;
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }


    public function storeDetail(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $Comment = new AcademyCommentDetail();

        // Asignamos los datos a las propiedades del objeto
        $Comment->CommentId= $data['CommentId'];
        $Comment->UserId= $data['UserId'];
        $Comment->Comment= $data['Comment'];


        // Guardamos el objeto en la base de datos
        $Comment->save();
    
        $insertedId = $Comment->id;
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();   
              

        $Comments = AcademyComment::join('maite_backend.users', 'users.id', '=', 'Comment.UserId')
                                    ->where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->Where('id', $data['id']);
                            }
                            if (isset($data['UserId'])) {
                                $query->Where('Comment.UserId', $data['UserId']);
                            }
                            
                            if (isset($data['ClassId'])) {
                                $query->Where('ClassId', $data['ClassId']);
                            }
                            
                         })
                         ->get();     

                         $payload = []; // Inicializa el arreglo de resultados

                         $fechaActual = time();

                         foreach ($Comments as $Comment) {
                             $CommentDetails = AcademyCommentDetail::join('maite_backend.users', 'users.id', '=', 'Comment_Detail.UserId')
                                                                    ->where('CommentId', $Comment->Id)->get();

                                                                    $commentDetailList=[];
                                                                    foreach ($CommentDetails as $CommentDetail) {

                                                                        /*
                                                                        $fechaCreacion = strtotime($CommentDetail->created_at);
                                                                        $resta = $fechaActual - $fechaCreacion;
                                                                        $minutosTranscurridosCreacion = floor($resta / 60);
                                                                        $horasTranscurridasCreacion = floor($resta / 3600);
                                                                        $diasTranscurridosCreacion = floor($resta / 86400);
                                                                        */

                                                                            $commentDetailList[] =[
                                                                                'id' => $CommentDetail->Id,
                                                                                'UserId' => $CommentDetail->UserId,
                                                                                'author' => $CommentDetail->name,
                                                                                'imageSrc' => '',
                                                                                'content' => $CommentDetail->Comment,
                                                                                'parentId' => '',
                                                                                'timeAgo' => $CommentDetail->created_at,
                                                                                'timeAgoUpdate' => $CommentDetail->updated_at,
                                                                            ];
                                                                    }
                            
                             $payload[] = [
                                'id' => $Comment->Id,
                                'UserId' => $Comment->UserId,
                                'author' => $Comment->name,
                                'imageSrc' => '',
                                'ClassId' => $Comment->ClassId,
                                'content' => $Comment->Comment,
                                'parentId' => '',
                                'timeAgo' => $Comment->created_at,
                                'timeAgoUpdate' => $Comment->updated_at,
                                'replies' => $commentDetailList
                            ];
                         }        
        
        return $payload;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $Id = $data['Id'];
        $UserId = $data['UserId'] ?? 0;
        $ClassId = $data['ClassId'] ?? 0;
        $Comment = $data['Comment'] ?? '';
        
        
       
        
        try {
            AcademyComment::where('id', $Id)->update([
                //'UserId' => $UserId,
                //'ClassId' => $ClassId,
                'Comment' => $Comment
                // Agrega otros campos que quieras actualizar aquí
            ]);
    
            // Actualización exitosa
            return response()->json(['message' => 'Datos actualizados correctamente']);
        } catch (\Exception $e) {
            // Error durante la actualización
            return response()->json(['error' => 'Error al actualizar los datos' . $e->getMessage()], 500);
        }
    }

    public function updateDetail(Request $request)
    {
        $data = $request->all();
        $Id = $data['Id'];
        $UserId = $data['UserId'] ?? 0;
        //$ClassId = $data['ClassId'] ?? 0;
        $Comment = $data['Comment'] ?? '';
        
        
       
        
        try {
            AcademyCommentDetail::where('id', $Id)->update([
                //'UserId' => $UserId,
                //'ClassId' => $ClassId,
                'Comment' => $Comment
                // Agrega otros campos que quieras actualizar aquí
            ]);
    
            // Actualización exitosa
            return response()->json(['message' => 'Datos actualizados correctamente']);
        } catch (\Exception $e) {
            // Error durante la actualización
            return response()->json(['error' => 'Error al actualizar los datos' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Validación
        /*$request->validate([
            'Id' => 'required|integer|exists:academy_comments,id',
        ]);*/

        $Id = $request->input('Id');

        // Intenta eliminar el registro
        $deleted = AcademyComment::where('id', $Id)->delete();

        $deleteDetail = AcademyCommentDetail::where('CommentId', $Id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'Registro eliminado correctamente']);
        } else {
            return response()->json(['message' => 'El registro no pudo ser eliminado'], 422);
        }
    }

    public function destroyDetail(Request $request)
    {
        // Validación
        /*$request->validate([
            'Id' => 'required|integer|exists:academy_comments,id',
        ]);*/

        $Id = $request->input('Id');

        

        $deleteDetail = AcademyCommentDetail::where('Id', $Id)->delete();

        if ($deleteDetail) {
            return response()->json(['message' => 'Registro eliminado correctamente']);
        } else {
            return response()->json(['message' => 'El registro no pudo ser eliminado'], 422);
        }
    }

    public function showCoursexComment(Request $request){
        //$data = $request->json()->all();
        $data = $request->all(); 

        //var_dump($data);exit();
        //$userid = $data['userid'];

        $Categories = AcademyComment::
                         where(function($query) use ($data) {  
                            if (isset($data['Id'])) {
                                $query->Where('Id', $data['Id']);
                            }
                            if (isset($data['Author'])) {
                                $query->Where('Author', $data['Author']);
                            }
                            if (isset($data['State'])) {
                                $query->Where('State', $data['State']);
                            }

                         })
                         
                         ->selectRaw('Id,Title,State')

                         
                         ->get();

        
                         $payload = []; // Inicializa el arreglo de resultados

                        foreach ($Categories as $Comment) {
                            $detalleCourses = AcademyCourse::where('CommentId', $Comment->Id)->get();
                            $coursesData = [];

                            foreach ($detalleCourses as $Course) {
                                $detalleClass = AcademyClass::where('CourseId', $Course->Id)->get();
                                $coursesData[] = [
                                    'Id' => $Course->Id,
                                    'Title' => $Course->Title,
                                    'Author' => $Course->Author,
                                    'Image' => $Course->Image,
                                    'Description' => $Course->Description,
                                    'CommentId' => $Course->CommentId,
                                    'State' => $Course->State,
                                    'classes' => $detalleClass
                                ];
                            }

                            $payload[] = [
                                'Id' => $Comment->Id,
                                'Title' => $Comment->Title,
                                'State' => $Comment->State,
                                'courses' => $coursesData
                            ];
                        }

        return $payload;
    }


}
