<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVtigerSession
{
    public function handle(Request $request, Closure $next)
    {
        $sessionId = $request->cookie('PHPSESSID');

        if (!$sessionId) {
            return response()->json([
                'error'   => true,
                'message' => 'Session ID missing. Please login again.',
                'status'  => 401,
            ], 401);
        }

        // Attach session ID to request so controllers/services can access it
        $request->merge(['session_id' => $sessionId]);

        return $next($request);
    }
}
