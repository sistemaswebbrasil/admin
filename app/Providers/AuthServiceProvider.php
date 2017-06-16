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
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        Log::info('AuthServiceProvider');
         $this->registerPolicies($gate);

         // $gate->define('admin-create', function ($user, $post) {
         //     Log::info('usuário: $user Post: $post');

         //     return $user->id == $post->user_id;
         // });    

        //$gate->define('manage-blog', 'User');

         $gate->before(function ($user, $ability) {
             if ($user) {
                 Log::info('Usuário: '.$user);                
                 Log::info('Abilidade: '.$ability);                
                 return false;
             }
        });     

        // $gate->define('manage-blog', function ($user, $post) {
        //     Log::info('usuário: $user Post: $post');

        //     //return $user->id == $post->user_id;
        // });        



    }
}
//Log::info('Menu Final: '.print_r( $arrayMenu,true));---> Exibe formatado como array pulando linhas