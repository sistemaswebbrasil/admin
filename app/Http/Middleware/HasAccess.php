<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

// use Illuminate\Support\Facades\Route;
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
     * Capturo todas as reequisições feitas e verifico se usuário está
     * autorizado a acessá-las.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action_name = $this->router->currentRouteName();
        if (!$this->user->can($action_name)) {
            /**
             * [$permissoesCad Permissões já cadastras no banco]
             * @var [type]
             */
            // app(Gate::class)->authorize($action_name);
        }
        return $next($request);
    }
}
