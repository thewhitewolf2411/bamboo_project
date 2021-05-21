<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectUser
{
    /**
     * Redirect user to login if not authorized.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // redirect to login if not authorized
        if(!Auth::user()){
            request()->session()->flash('nouser', true);
            return redirect('/userprofile');
        }
        
        return $next($request);
    }
}
