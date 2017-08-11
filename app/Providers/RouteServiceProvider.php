<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        //$routeCollection = Route::getRoutes();
        // $app    = app();
        $routes = Route::getRoutes();
        //$app->routes->getRoutes();

        foreach ($routes as $value) {
            //echo $value->getPath();
            // Log::info('URI :' . print_r($value->uri(), true));
            Log::info('getName :' . print_r($value->getName(), true));
            // Log::info('getPrefix :' . print_r($value->getPrefix(), true));
            // Log::info('getActionMethod :' . print_r($value->getActionMethod(), true));
        }

        // foreach (Route::getRoutes() as $route) {
        //     //var_dump($route->getUri());
        //     //Log::info('Rota Capturada '.print_r(  $routegetRoutes() ) );
        //     //var_dump(Route::getRoutes()->getRoutes());

        // }

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
