<?php

namespace App\Model;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CriaNovaPermissao
{

    public static function verifica($permissoes)
    {
        // Log::info('Chamou o construtor de CriaNovaPermissao');
        if (count($permissoes) > 0) {
            //Log::info('Achou permissões '.$permissoes);
            foreach ($permissoes as $permissao) {
                //$this->verificaSePermissaoExiste($permissao);
                if (!static::verificaSePermissaoExiste($permissao)) {
                    static::criaNovaFuncao($permissao);
                }
            }
        }
    }

    protected static function verificaSePermissaoExiste($permissao)
    {
        $existePermissao = DB::table('permissions')->where('name', $permissao)->get();
        if (count($existePermissao) > 0) {
            // Log::info('Permissão existe '.$permissao);
            return true;
        } else {
            // Log::info('Permissão não existe '.$permissao);
            return false;
        }
    }

    protected static function criaNovaFuncao($permissao)
    {
        // Log::info('Criar a nova permissão '.$permissao);
        $permission               = new Permission();
        $permission->name         = $permissao;
        $permission->display_name = $permissao;
        $permission->save();

        static::associaPermissaoAoAdmin($permission);
    }

    protected static function associaPermissaoAoAdmin($permission)
    {
        // Log::info('Assosiar nova permissão ao administrador '.$permissao);
        $admin = Role::where('name', 'admin')->first();
        $admin->attachPermission($permission);
    }
}
