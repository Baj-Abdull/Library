<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
      
        // 1. Get the current token used for this request
        $token = $request->user()->currentAccessToken();
        
        // 2. Check if the token exists and has the correct name ('admin')
        // Note: Ensure you created the token with ->createToken('admin') in your login controller!
        if ($token->name !== 'admin') {
            return response()->json([
                'status' => 0,
                'message' => 'Access Denied: You do not have admin privileges.',
            ], 403);
            
            }
           
        
        // 3. If the check passes, proceed
        return $next($request);
    }
}