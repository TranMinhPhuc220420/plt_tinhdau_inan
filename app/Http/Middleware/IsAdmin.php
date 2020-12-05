<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = redirect()->to('/admin/login')->with('result_login', false);
        if ($request->cookie('token') != null) {

            // Confirm database has token of this admin
            if (User::checkToken($request->cookie('token'))) {
                $response = $next($request);
            }
        }

        return $response;
    }
}
