<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers' , 'Authorization, Content-Type');
        $response->header('Access-Control-Expose-Headers' , 'Authorization');
        $response->header('Access-Control-Max-Age' , '86400');

        // Permitir el acceso desde el origen deseado (cambia 'http://localhost:5173' según tu necesidad)
        $allowedOrigin = 'http://localhost:5173';

        // Configurar las cabeceras CORS
        header("Access-Control-Allow-Origin: $allowedOrigin");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, weight, otras-cabeceras-que-necesitas");

        // Permitir que las cookies se incluyan en las solicitudes (si es necesario)
        header("Access-Control-Allow-Credentials: true");

        // Configurar la duración de la caché de las cabeceras preflight (solicitud OPTIONS)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("Access-Control-Max-Age: 1728000");
            header("Content-Length: 0");
            header("Content-Type: text/plain");
        }

        // Tu lógica de la aplicación va aquí...

        // Ejemplo de respuesta JSON
        $responseData = array('message' => 'Respuesta desde el servidor PHP');
        echo json_encode($responseData);


        return $response;
    }
}
