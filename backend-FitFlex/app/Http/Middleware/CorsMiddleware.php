<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\StripePaymentController; 
use Illuminate\Support\Facades\Log;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Log::debug($request);
        
        // Verifica si se ha encontrado una ruta para la solicitud actual
        if ($request->route() && $request->route()->getController() instanceof StripePaymentController) {
            // Configura los encabezados CORS permitidos para el controlador StripePaymentController
            $response = $next($request);
            $response->header('Access-Control-Allow-Origin', '*');
            $response->header('Access-Control-Allow-Methods', 'GET, POST');
            $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            return $response;
        }

        return $next($request);
    }
}
