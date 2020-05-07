<?php

namespace App\Http\Middleware;

use Closure;

class DisasterMiddleware
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
        $params = $request->route()->parameters();
        $request->attributes->add(['disaster_id' => $params['disaster_id']]);
        return $next($request);
    }
}
