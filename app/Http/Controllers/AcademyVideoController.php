<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AcademyVideoController extends Controller
{
    public function subirVideo(Request $request)
    {
     
        
        $validator = Validator::make($request->all(), [
            'video' => 'required|file|mimes:mp4,avi,mpg,mov,ogg,webm|max:6056', // Cambia las extensiones y el tamaño según tus necesidades
        ], [
            'video.required' => 'Debes seleccionar un video para subir.',
            'video.file' => 'El campo debe ser un archivo válido.',
            'video.mimes' => 'El video debe ser de uno de los siguientes formatos: mp4, avi, mpg, mov, ogg, webm.',
            'video.max' => 'El tamaño máximo permitido para el video es 6056 KB (6.05 MB).',
        ]);
    
        if ($validator->fails()) {
            // Si la validación falla, devuelve un mensaje de error en formato JSON
            return response()->json(['error' => $validator->errors()->all()], 400);
        }
    
        // Si la validación es exitosa, procede con el almacenamiento del video
        if ($request->file('video')) {
            $video = $request->file('video');
            
            // Define el directorio donde se almacenarán los videos subidos
            $uploadDirectory = public_path('videos/subfolder'); // Cambia "subfolder" al nombre de la carpeta que desees
            
            // Asegúrate de que el directorio exista; si no, créalo
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }
            
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move($uploadDirectory, $videoName);
        }
        
        // Puedes guardar información adicional en la base de datos si es necesario.
        
        return response()->json(['message' => 'Video subido exitosamente.']);
    }
}
