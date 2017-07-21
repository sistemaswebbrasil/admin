<?php

namespace App\Providers;

use App\Model\MenuAcesso;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Esta função é executada assim quando a aplicação é iniciada
     *
     *
     */

    protected function cadastrarRotas()
    {
        //Log::info('Função para cadastrar rotas no menu de acesso');
        //Log::info('Menu Final: '.print_r( $arrayMenu,true));

        foreach (Route::getRoutes() as $route) {
            //var_dump($route->getUri());
            // Log::info('Rotas: '.$route->getUri());
        }
    }

    public function boot(Dispatcher $events)
    {
        //Carbon::setLocale(env('LOCALE', 'en'));
        // Carbon::setLocale(env('LOCALE', 'pt'));
        Date::setLocale('pt');
        $this->cadastrarRotas();

        /**
         * Cria o menu inicial do AdminLte que neste caso será alimentado pela tabela menuacesso
         */
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add(trans('Menu '));
            /**
             * Select * from menuacesso where  parent = 0 or parent = ''
             */
            $items = DB::table('menuacesso')
                ->where('parent', 0)
                ->get();
            foreach ($items as $item) {
                /**
                 * Agora dentro dos itens principais de menu verifico a primeira camada de filhos
                 * select * from menuacesso where parent = 1 and parent > 0
                 */
                $subItems = DB::table('menuacesso')->where('parent', '=', $item->id)->where('parent', '>', '0')->get();
                /**
                 * Se encontrado o subitem será verificado mais 2 niveis de filhos criando uma hierarquia , senão irá gerar o item de menu imediatamente
                 */
                if (count($subItems) > 0) {
                    $ArraySubMenu  = array();
                    $ArraySubMenu2 = array();
                    $ArraySubMenu3 = array();
                    $arrayTMP      = array();
                    $arrayTMP2     = array();
                    $arrayTMP3     = array();
                    foreach ($subItems as $subItem) {
                        $subItems2 = DB::table('menuacesso')->where('parent', '=', $subItem->id)->where('parent', '>', '0')->get();
                        if (count($subItems2) > 0) {
                            foreach ($subItems2 as $subItem2) {
                                $subItems3 = DB::table('menuacesso')->where('parent', '=', $subItem2->id)->where('parent', '>', '0')->get();
                                if (count($subItems3) > 0) {
                                    foreach ($subItems3 as $subItem3) {
                                        $ArraySubMenu3 = [
                                            'text'       => $subItem3->text,
                                            'url'        => $subItem3->url,
                                            'icon'       => $subItem3->icon,
                                            'icon_color' => $subItem3->icon_color,
                                            'can'        => $subItem3->permission,
                                        ];
                                        array_push($arrayTMP3, $ArraySubMenu3);
                                    }

                                    $ArraySubMenu2 = [
                                        'text'       => $subItem2->text,
                                        'url'        => $subItem2->url,
                                        'icon'       => $subItem2->icon,
                                        'icon_color' => $subItem2->icon_color,
                                        'can'        => $subItem2->permission,
                                        'submenu'    => $arrayTMP3,
                                    ];
                                    array_push($arrayTMP2, $ArraySubMenu2);
                                } else {
                                    $ArraySubMenu2 = [
                                        'text'       => $subItem2->text,
                                        'url'        => $subItem2->url,
                                        'icon'       => $subItem2->icon,
                                        'icon_color' => $subItem2->icon_color,
                                        'can'        => $subItem2->permission,
                                    ];
                                    array_push($arrayTMP2, $ArraySubMenu2);
                                }
                            }
                            $ArraySubMenu = [
                                'text'       => $subItem->text,
                                'url'        => $subItem->url,
                                'icon'       => $subItem->icon,
                                'icon_color' => $subItem->icon_color,
                                'can'        => $subItem->permission,
                                'submenu'    => $arrayTMP2,
                            ];
                            array_push($arrayTMP, $ArraySubMenu);
                        } else {
                            /**
                             * O Array criado , é criado a definição junto com os dados contidos , por isso precisamos
                             * acumular o valor
                             * por isso existe o array do submentu e arrayTMP.depois de definido a função array_push
                             *  junta o arrayTMP e o submenu atual
                             */
                            $ArraySubMenu = [
                                'text'       => $subItem->text,
                                'url'        => $subItem->url,
                                'icon'       => $subItem->icon,
                                'icon_color' => $subItem->icon_color,
                                'can'        => $subItem->permission,
                            ];
                            array_push($arrayTMP, $ArraySubMenu);
                        }
                    }
                    $arrayMenu = [
                        'text'       => $item->text,
                        'url'        => $item->url,
                        'icon'       => $item->icon,
                        'icon_color' => $item->icon_color,
                        'can'        => $item->permission,
                        'submenu'    => $arrayTMP,
                    ];
                    $event->menu->add($arrayMenu);
                } else {
                    $arrayMenu = [
                        'text'       => $item->text,
                        'url'        => $item->url,
                        'icon'       => $item->icon,
                        'icon_color' => $item->icon_color,
                        'can'        => $item->permission,
                    ];
                    /**
                     * Este comando é que adiciona finalmente o item de menu
                     */
                    $event->menu->add($arrayMenu);
                }
            }
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
