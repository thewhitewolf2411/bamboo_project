<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserGroupMiddleware
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
        if($request->user() !== NULL ){
            $role = Auth::user()->type_of_user; 
            if($role !== 0){
                return redirect('/portal');
            }
        }

        #dd("here");

        return $next($request);

    }
}
