<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OAuthAuthorizr
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->getPathInfo() == '/oauth/authorize'){

            
            if(Auth::check()){
            
                if($request->user()->isAllowedForClient($request->client_id)){
                    return $next($request);
                }

                abort(403);
            }

        }


        return $next($request);
    }
}
