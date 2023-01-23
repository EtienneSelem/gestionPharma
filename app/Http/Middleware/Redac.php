<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Redac
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && ($user->role === 'admin' || $user->role === 'redac')) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}