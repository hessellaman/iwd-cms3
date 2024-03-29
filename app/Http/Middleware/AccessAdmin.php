<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // Er worden drie gebruikersrollen onderscheiden (en sommige geregistreerde gebruikers hebben geen rol)
    public function handle($request, Closure $next)
    {
        if (Auth::check() && 
            Auth::user()->hasAnyRole(['admin','editor', 'author'])) {
                return $next($request);
        }

        return redirect('home');
    }
}
