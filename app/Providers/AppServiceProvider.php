<?php

namespace App\Providers;

use App\Model\MenuAcesso;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add(trans('Menu '));

            $items = MenuAcesso::all()->map(function (MenuAcesso $page) {
                return [
                    'text' => $page['text'],
                    'url' => $page['url'] //route('admin.pages.edit', $page)
                ];
            });

            $event->menu->add(...$items);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
