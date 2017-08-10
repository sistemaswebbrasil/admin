<?php

namespace App\Http\Middleware;

use Closure;

class InputCleanup
{
    /**
     * Handle an incoming request.
     * Usado para transformar os valores NULL em valores empty para não inserir NULL no banco
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $input = $request->input();
        array_walk_recursive($input, function (&$value) {
            if (is_null($value) && empty($value)) {
                $value = '';
            }
        });

        $request->replace($input);
        return $next($request);
    }
}
