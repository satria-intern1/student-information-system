<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // if the role that are pass in argument
        // not meet your role
        // then redirect to dashboard

        //the argument can take multiple role, it will in an array


        if (!in_array(auth()->user()->role, $roles)) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
