<?php

namespace App\Providers;

use App\Model\MenuAcesso;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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



            $items = DB::table('menuacesso')->where('parent', '')->get();
            foreach ($items as $item) {
                
                $subItems = DB::table('menuacesso')->where('parent','=',$item->id)->where('parent','>','0')->get();  

                Log::info('Quantidade de Itens encontrados: '.count($subItems));

                if (count($subItems) > 0){
                    $txtSubMenu = array();
                    $arrayTMP = array();
                    foreach ($subItems as $subItem) {

                        $txtSubMenu = [
                            'text' => $subItem->text,
                            'url' =>  $subItem->url,
                        ];                            
                        

                        array_push($arrayTMP,$txtSubMenu);
                    }

                    Log::info('SubMenu Final: '.print_r( $txtSubMenu,true));

                    $txtMenu = [
                        'text' => $item->text,
                        'url' =>  $item->url,  
                        'submenu' => $arrayTMP
                                                                             
                    ];
                    Log::info('Menu Final: '.print_r( $txtMenu,true));
                }else{
                    $txtMenu = [
                        'text' => $item->text,
                        'url' =>  $item->url,
                    ];     
                    Log::info('Menu: '.print_r( $txtMenu,true));
                    $event->menu->add($txtMenu);
                }
            }

            $event->menu->add($txtMenu);
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
