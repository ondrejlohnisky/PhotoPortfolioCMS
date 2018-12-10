<?php

namespace App\Http\Middleware;

use Closure;

class FilterWeb
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

        if(strpos($request->path(),'admin')!==false){
            return redirect('admin/index');
        }
        return $next($request);
    }
}
