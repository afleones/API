<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = [
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB,
        'Content-Security-Policy' => "default-src 'self';
                                      script-src 'self' 'unsafe-inline' 'unsafe-eval'; 
                                      style-src 'self' 'unsafe-inline'; img-src 'self' data: blob:; 
                                      font-src 'self'; object-src 'self'; 
                                      frame-src 'self' https://documents.genomax.app; 
                                      frame-ancestors 'self' https://documents.genomax.app; 
                                      download 'self';"
    ];
                
}
