<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate){
        $this->registerPolicies();
        $this->verificarSeAutorizado($gate);
    }

    protected function verificarSeAutorizado($gate){
        $gate->before(function ($user, $ability) {
            if ($user) {
                // Log::info('Usuário: '.$user);                
                //Log::info('Abilidade Necessária: '.$ability);
                $roles = $user->getRoleListAttribute();
                $permissoes = $user->getPermissionListAttribute();
                //Log::info('Permissoes: '.print_r( $permissoes ,true));

                if ((in_array($ability, $roles)) || (in_array($ability, $permissoes))){
                    //Log::info('Encontrado a habilidade nescessaria');
                    return true;
                }
                //Log::info('Usuário não autorizado');
                return false;                
            }
        });
    }
}
