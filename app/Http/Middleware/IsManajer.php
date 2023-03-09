<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsManajer
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
        if(auth()->user()->is_admin != 'MANAJER'){
            return $next($request);
        }
    
        return redirect('home')->with('error',"You don't have Manajer access.");
    }
}
