<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstructorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // role = instructor
        if (auth()->user()->role != 2) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
