<?php
namespace App\Http\Filter;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class MenuAcessoFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        //Log::info('Chamou aqui ? MenuAcessoFilter');
        //Log::info('Item: '.print_r( $item,true));
        //Log::info('Item:'.$item);
        //Log::info('Builder:'.$builder);
        //

        // dd($builder);

        if (empty($item['can'])) {
            return true;
        } else {
            // dd($item);
        }
        return false;

        // if (isset($item['permission'])) {
        //     Log::info('#################################TESTE################################');
        //     return false;
        // }
        // dd($item);

        // return false;
    }
}
//GateFilter
