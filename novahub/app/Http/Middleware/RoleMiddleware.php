<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if(!Auth::check()){
            return redirect('/login');
        }

        if(Auth::user()->role !== $role){
            return redirect('/catalog')->with('error','Accès non autorisé.');
        }
        
        return $next($request);
    }
}
