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
        //if (!$response instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers' , 'Authorization, Content-Type');
        $response->header('Access-Control-Expose-Headers' , 'Authorization');
        $response->header('Access-Control-Max-Age' , '86400');
        //}

        return $response;
    }
}
