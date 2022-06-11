<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HttpsRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (App::environment('production')) {
            if ($request->getScheme()=='https') {
                //echo Request::HEADER_X_FORWARDED_PROTO;
                return redirect()->secure($request->getRequestUri());
            }
        }
        return $next($request);
    }
}
