<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;

// use Illuminate\Routing\Router;

// use Illuminate\Support\Facades\Route;

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

            Log::info('****TESTE ' . $action_name);
// password.request  register
            if (
                ($action_name == 'login') ||
                ($action_name == 'password.request') ||
                ($action_name == 'register') ||
                ($action_name == 'logout') ||
                (empty($action_name))
            ) {
                return $next($request);
            }

            app(Gate::class)->authorize($action_name);
        }
        return $next($request);
    }
}
