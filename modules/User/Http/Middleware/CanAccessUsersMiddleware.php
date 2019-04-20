<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Entities\User;

class CanAccessUsersMiddleware
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
        if (!User::find($request->username)) {
            return redirect(env('LOGIN_PATH'));
        }
        return $next($request);
    }
}
