<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // role = admin
        if (auth()->user()->role != 1) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
