<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\WebService;

class CheckIp{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if($request == )
        return $next($request);
    }
}
