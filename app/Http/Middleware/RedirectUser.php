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
        $allowed = [
            "217.34.54.192",
            "109.170.152.167",
            "217.138.25.114",
            "192.168.9.43"
        ];
        // redirect to login if not authorized
        if(!Auth::user()){
            request()->session()->flash('nouser', true);
            return redirect('/userprofile');
        } else {
            $ip = $request->ip();
            if(!in_array($ip, $allowed)){
                //dd(Auth::user());
                if(Auth::user()){
                    Auth::logout();
                    // $this->guard()->logout();
                }
                return redirect('/');
            }
        }
        
        return $next($request);
    }
}
