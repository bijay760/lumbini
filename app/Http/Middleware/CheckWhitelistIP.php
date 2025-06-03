<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckWhitelistIP
{
    protected $whitelistedIps = [
        '127.0.0.1',
        '199.241.137.139',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!in_array($request->ip(), $this->whitelistedIps)) {
            return redirect('/');
        }

        return $next($request);
    }
}
