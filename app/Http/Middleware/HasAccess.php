<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Routing\Router;

class HasAccess
{

    protected $router;
    protected $user;

    public function __construct(User $user, Router $router)
    {
        $this->router = $router;
        $this->user   = $user;
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
        // $action_name = $this->router->getRoutes()->match($request)->getActionName();
        $action_name = $this->router->getCurrentRoute()->getName();
        // Log::info('$action_name: ' . print_r($action_name, true));
        // dd($action_name);

        // $this->authorize($action_name);
        $this->user->can('updateasaa');

        return $next($request);
    }
}
