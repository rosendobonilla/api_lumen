<?php

namespace App\Http\Middleware;

use Closure;

class RequestJson
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
        if(!$request->isJson()){
            return response()->json(['error' => 'No esta autorizado a acceder a estos datos.'], 401,[]);
        }
        return $next($request);
    }
}
