<?php

namespace App\Http\Filter;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust;
use Illuminate\Support\Facades\Log;

class MenuAcessoFilter implements FilterInterface
{

    public function transform($item, Builder $builder)
    {

        //Log::info('Chamou aqui ? MenuAcessoFilter');

        //Log::info('Item: '.print_r( $item,true));
        //Log::info('Item:'.$item);
        //Log::info('Builder:'.$builder);

        if (isset($item['permission']) && ! Laratrust::can($item['permission'])) {
            // Log::info('Item: '.$item['permission']);
            // Log::info('Laratrust: '.Laratrust::can($item['permission']));
            return false;
        }

        return $item;
    }
}
//GateFilter