<?php
namespace App\Http\Middleware;

use Closure;

class AfterLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        // Perform actions after login, using data passed from the controller
        $userId = $request->get('user_id');
        $action = $request->get('action');

        // Perform actions based on the data

        return $next($request);
    }
}