<?php

namespace App\Http\Middleware;

use App;
use Carbon\Carbon;
use Closure;
use Config;
use Session;

class SetLocale
{
    /**
     *
     * Redefine as linguagens usadas por diferentes partes do projeto
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $raw_locale = Session::get('locale');
        if (in_array($raw_locale, Config::get('app.locales'))) {
            $locale = $raw_locale;
        } else {
            $locale = Config::get('app.locale');
        }

        App::setLocale($locale);
        Carbon::setLocale(env('LOCALE', $locale));
        date_default_timezone_set('America/Sao_Paulo');

        if ($locale == 'pt-br') {
            setlocale(LC_TIME, 'pt_BR.utf8');
        } elseif ($locale == 'en') {
            setlocale(LC_TIME, 'en.utf8');
        }
        return $next($request);
    }
}
