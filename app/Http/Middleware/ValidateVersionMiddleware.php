<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateVersionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $v = $request->get('v');
        if (!$v) {
            return response()->json([
                'message' => 'Please upgrade your version',
            ]);
        }

        if ($v != '1.0.0') {
            return response()->json([
                'message' => 'Please upgrade your version',
            ]);
        }
        return $next($request);
    }
}
