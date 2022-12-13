<?php
namespace App\Http\Middleware;

use App\Helpers\AuthSessionHelper;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class SessionValidator
{
    /**
     * @param Request $request 
     * @param Closure $next 
     * @return mixed 
     * @throws BindingResolutionException 
     * @throws NotFoundExceptionInterface 
     * @throws ContainerExceptionInterface 
     * @throws RouteNotFoundException 
     */
    function handle(Request $request, Closure $next)
    {
        $authSession = AuthSessionHelper::getCurrent();
        if ( !$authSession->isLoggedIn() ) {
            session()->flash('alert', ['type' => 'error', 'text' => __('Debe iniciar sesión para continuar')]);
            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}