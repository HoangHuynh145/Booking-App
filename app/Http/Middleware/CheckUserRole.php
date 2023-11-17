<?php

// app/Http/Middleware/CheckUserRole.php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {
        // Check if the user has role 1
        if ($request->user() && $request->user()->role == 1) {
            return $next($request); 
        }

        // Redirect back to the home page if the user doesn't have the required role
        return redirect('/')->with('error', 'You do not have the required role.');
    }
}
