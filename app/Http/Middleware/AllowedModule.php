<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Helpers\CustomHelper;

class AllowedModule{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $moduleName){

        $ADMIN_ROUTE_NAME = config('custom.ADMIN_ROUTE_NAME');

        if(!CustomHelper::isAllowedModule($moduleName)){
            if (Auth::check()) {
                return redirect(url($ADMIN_ROUTE_NAME));
            }
            return redirect(url('/'));
        }

        return $next($request);
    }
}
