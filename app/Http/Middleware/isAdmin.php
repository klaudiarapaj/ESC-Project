<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class isAdmin
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
        //check if user is admin
        if (Auth::user()->role == 'admin') {
            return $next($request);
        }

        //if user isnt admin redirect to home
        return redirect('/home');

      /*  if (auth()->check() && auth()->user()->hasRole('admin')) {
            return $next($request);
        } */

        abort(403, 'Unauthorized action.');
    }
}
