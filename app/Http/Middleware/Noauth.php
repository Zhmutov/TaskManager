<?php
/**
 * Created by PhpStorm.
 * User: vgalatin
 * Date: 03.11.2018
 * Time: 23:18
 */

namespace App\Http\Middleware;


use Closure;
class Noauth
{
    public function handle($request, Closure $next)
    {
        if (session()->get('user_id','')=='') {
            return redirect('/');
        }

        return $next($request);
    }
}