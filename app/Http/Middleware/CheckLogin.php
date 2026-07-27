<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('login')) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}