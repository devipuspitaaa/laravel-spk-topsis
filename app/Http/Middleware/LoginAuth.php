<?php

namespace App\Http\Middleware;

use Closure;

class LoginAuth
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
        $session = $request->session();
        if (!$session->has('auth')) {
            $session->put('redirect', $request->path());
            return redirect('/login');
        }
        
        return $next($request);
    }
}
