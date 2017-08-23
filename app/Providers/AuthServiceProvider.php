<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    protected $contador;

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {

        $this->verificarSeAutorizado($gate);
    }

    /**
     * [verificarSeAutorizado Verifico se existe permissão do usuário atual acessar o conteúdo]
     * @param  [type] $gate [description]
     * @return [type]       [description]
     */
    protected function verificarSeAutorizado($gate)
    {
        $gate->before(function ($user, $ability) {
            \Config::set('ability', '');
            // dd($user->id);
            if ($user->id) {

                $roles      = $user->getRoleListAttribute();
                $permissoes = $user->getPermissionListAttribute();

                // dd($user);

                $this->contador += 1;
                if ($this->contador == 1) {
                    // file_put_contents("/var/www/html/laravel/admin/storage/logs/laravel.log", "");
                    Log::info('Usuário: ' . print_r($user->name, true));
                    Log::info('Permissoes: ' . print_r($permissoes, true));
                    Log::info('Funções: ' . print_r($roles, true));
                }

                Log::info('AuthServiceProvider execução ' . $this->contador);
                Log::info('Abilidade Necessária: ' . $ability);

                if ((in_array($ability, $roles))
                    || (in_array($ability, $permissoes))
                    || (empty(trim($ability)))
                    || (in_array('admin', $roles))
                ) {
                    Log::info('AUTORIZADO:Encontrado a habilidade nescessaria');
                    return true;
                }
                Log::info('NEGADO:Usuário não autorizado');
                // abort(403, trans('geral.acessonegadopagina', ['name' => $ability]));

                \Config::set('ability', trans('geral.acessonegadopagina', ['name' => $ability]));

                return false;
                // abort(403, trans('geral.acessonegadopagina', ['name' => $ability]));
            }
        });
    }
}
