<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    protected $auth;

    /**
     * Authenticate constructor.
     * @param $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->guest()) {
            if($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('user/login');
            }
        }

        return $next($request);
    }
}
