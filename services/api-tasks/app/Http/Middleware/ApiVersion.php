<?php

namespace App\Http\Middleware;

class ApiVersion
{
    public function handle($request, $next, $guard)
    {
        config(['app.api.version' => $guard]);
        return $next($request);
    }
}
