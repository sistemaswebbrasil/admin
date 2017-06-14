<?php

namespace App\Http\Filter;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust;

class MenuAcessoFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['permission']) && ! Laratrust::can($item['permission'])) {
            return false;
        }

        return $item;
    }
}