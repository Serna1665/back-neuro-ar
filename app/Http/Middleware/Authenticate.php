<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return null; // Evita la redirección a 'login'
        }
    }
}
