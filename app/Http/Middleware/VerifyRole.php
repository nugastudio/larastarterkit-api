<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Exceptions\RoleDeniedException;

use Auth;

class VerifyRole
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request    $request
     * @param \Closure   $next
     * @param int|string $role
     *
     * @throws RoleDeniedException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // dd($role);
        if ($this->auth->check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        return response()->json(array(
            'status_code'    =>  403,
            'message'   =>  'Unauthorized permission denied. You dont have permission as '.$role
        ), 403);
        // throw new RoleDeniedException($role);
    }
}
