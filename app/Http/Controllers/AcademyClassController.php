<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AcademyClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Class = AcademyClass::selectRaw("id,
                                    Title,
                                    Author,
                                    Image,
                                    CourseId,
                                    Video,
                                    Description,
                                    State
        ")->get();
        return $Class;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        
        // Creamos un nuevo objeto del modelo
        $Class = new AcademyClass();

        // Asignamos los datos a las propiedades del objeto
        $Class->Title= $data['Title'];
        $Class->Author= $data['Author'];
        $Class->Image= $data['Image'];
        $Class->CourseId= $data['CourseId']; 


        $validator = Validator::make($request->all(), [
            'Video' => 'required|file|mimes:mp4,avi,mpg,mov,ogg,webm,pdf|max:605600', // Cambia las extensiones y el tamaño según tus necesidades
        ], [
            'Video.required' => 'Debes seleccionar un Video para subir.',
            'Video.file' => 'El campo debe ser un archivo válido.',
            'Video.mimes' => 'El video debe ser de uno de los siguientes formatos: mp4, avi, mpg, mov, ogg, webm.',
            'Video.max' => 'El tamaño máximo permitido para el video es 605600 KB (6.05 MB).',
        ]);
    
        if ($validator->fails()) {
            // Si la validación falla, devuelve un mensaje de error en formato JSON
            return response()->json(['error' => $validator->errors()->all()], 400);
        }
    
        // Si la validación es exitosa, procede con el almacenamiento del video
        if ($request->file('Video')) {
            $video = $request->file('Video');
            
            // Define el directorio donde se almacenarán los videos subidos
            $uploadDirectory = public_path('videos'); // Cambia "subfolder" al nombre de la carpeta que desees
            
            // Asegúrate de que el directorio exista; si no, créalo
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }
            
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move($uploadDirectory, $videoName);
        }

        $Class->Video= '/public/videos/'.$videoName; //$data['Video'];
        
        
        $Class->Description= $data['Description']; 
        $Class->State= $data['State'];


        // Guardamos el objeto en la base de datos
        $Class->save();
    
        $insertedId = $Class->Id;
    
        // Retornamos una respuesta de éxito
        return response()->json(['message' => 'Datos insertados correctamente', 'inserted_id' => $insertedId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->all();   
              

        $Class = AcademyClass::where(function($query) use ($data) {
                            if (isset($data['id'])) {
                                $query->Where('id', $data['id']);
                            }
                            if (isset($data['Author'])) {
                                $query->Where('Author', $data['Author']);
                            }
                            if (isset($data['State'])) {
                                $query->Where('State', $data['State']);
                            }
                            if (isset($data['CourseId'])) {
                                $query->Where('CourseId', $data['CourseId']);
                            }
                         })
                         ->get();     

                                         
        
        return $Class;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademyClass $AcademyClass)
    {
        $data = $request->all();
        $Id = $data['Id'];
        $Title = $data['Title'] ?? '';
        $Author = $data['Author'] ?? 0;
        $Image = $data['Image'] ?? 0;
        $CourseId = $data['CourseId'] ?? 0;
        $Video = $data['Video'] ?? '';
        $Description = $data['Description'] ?? '';
        $State = $data['State'] ?? 0;
        
        try {
            AcademyClass::where('id', $Id)->update([
                'Title' => $Title,
                'Author' => $Author,
                'Image' => $Image,
                'CourseId' => $CourseId,
                'Video' => $Video,
                'Description' => $Description,
                'State' => $State,
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
    public function destroy(string $id)
    {
        //
    }
}
