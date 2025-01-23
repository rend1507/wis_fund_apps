<?php
// app/Http/Middleware/CheckRoleMiddleware.php

namespace App\Http\Middleware;

use Closure;

class CheckRoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $user = auth()->user();

        foreach ($roles as $role) {
            if ($user->role === $role) {
                $tableName = $this->getTableNameBasedOnRole($user->role);
                $userData = \DB::table($tableName)->where('id_user', $user->id)->first();

                if ($userData) {
                    // Perform any additional logic here if needed
                    return $next($request);
                }
            }
        }

        return redirect('')->with('danger', 'Unauthorized access.');
    }

    // Function to return the table name based on the user role
    private function getTableNameBasedOnRole($role)
    {
        switch ($role) {
            case 0:
            case 1:
                return 'user_high';
            case 2:
            case 3:
            case 4:
                return 'user_base';
            case 5:
            case 6:
                return 'user_intermediate';
            default:
                return 'users'; // Default table name
        }
    }
}
