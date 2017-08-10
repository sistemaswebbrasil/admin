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
        $this->registerPolicies();
        $this->verificarSeAutorizado($gate);
    }

    protected function verificarSeAutorizado($gate)
    {
        $gate->before(function ($user, $ability) {
            if ($user) {

                $roles      = $user->getRoleListAttribute();
                $permissoes = $user->getPermissionListAttribute();

                $this->contador += 1;
                if ($this->contador == 1) {
                    Log::info('Usuário: ' . print_r($user->name, true));
                    Log::info('Permissoes: ' . print_r($permissoes, true));
                    Log::info('Funções: ' . print_r($roles, true));
                }

                Log::info('AuthServiceProvider execução ' . $this->contador);
                Log::info('Abilidade Necessária: ' . $ability);

                if ((in_array($ability, $roles))
                    || (in_array($ability, $permissoes))
                    || (empty($ability))) {
                    Log::info('AUTORIZADO:Encontrado a habilidade nescessaria');
                    return true;
                }
                Log::info('NEGADO:Usuário não autorizado');
                return false;
            }
        });
    }
}
