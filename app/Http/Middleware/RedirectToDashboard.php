<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RedirectToDashboard
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
