<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class adminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $current = Auth::guard('web')->user();
        if($current) {
            return $next($request);
        } else {
            return redirect('admin/login');
        }
    }
}
