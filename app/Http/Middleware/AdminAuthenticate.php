<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AdminAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin.login');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->auth->guard('admin')->guest()) {
            // 未認証時の処理
            return $this->unauthenticated($request, $guards);
        }

        return $next($request);
    }
}
