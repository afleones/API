<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use App\Utils\DatabaseUtils;

class FileController extends Controller
{
    

public function uploadImage(Request $request, $filename)
{
    //var_dump( $filename);
    // Verificar si se ha enviado un archivo
    if ($request->hasFile('image')) {
        // Obtener el archivo enviado
        $file = $request->file('image');

        // Obtener la extensión original del archivo
        $extension = $file->getClientOriginalExtension();

        // Validar que sea un archivo de imagen (PNG o JPG)
        if (in_array($extension, ['png', 'jpg'])) {
            // Encriptar el nombre de la base de datos
            $DBName = DB::connection('maite')->getDatabaseName();
            // $encryptedDBName = Crypt::encryptString($DBName);

            $encryptedDBName = DatabaseUtils::enkryptString();

            // Crear la carpeta 'images/{encryptedDBName}' si no existe
            $folderPath = public_path('images/'.$encryptedDBName);
            if (!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            // Obtener el objeto de imagen utilizando Intervention Image
            $image = Image::make($file);

            // Convertir a formato JPG si es un archivo PNG
            if ($extension === 'png') {
                $image->encode('jpg', 90); // Convierte a JPG con calidad del 90%
            }

            // Guardar la imagen en la ruta pública con el nombre especificado
            $image->save(public_path('images/'.$encryptedDBName.'/'.$filename.'.jpg'));

            // Devolver una respuesta con la URL del archivo guardado
            return response()->json([
                'message' => 'Archivo subido exitosamente',
                'url' => asset('images/'.$encryptedDBName.'/'.$filename.'.jpg')
            ], 200);
        }
    }

    // Devolver una respuesta de error si no se ha enviado un archivo válido
    return response()->json([
        'message' => 'Archivo inválido'
    ], 400);
}

}
