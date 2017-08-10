<?php

use Illuminate\Database\Seeder;

class DadosIniciais extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('menuacesso')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        DB::table('users')->insert([
            ['name' => 'Adriano Faria Alves', 'email' => 'adriano.faria@gmail.com', 'password' => bcrypt('123456')],
            ['name' => 'Michele Cristina Teixeira Faria Alves', 'email' => 'micheletalves@gmail.com', 'password' => bcrypt('123456')],
        ]);

        DB::table('roles')->insert([
            ['name' => 'admin', 'display_name' => 'Administrador'],
            ['name' => 'usuario', 'display_name' => 'Usuário'],
        ]);

        DB::table('permissions')->insert([
            ['name' => 'listar-menu', 'display_name' => 'Listar Menu'],
            ['name' => 'listar-usuario', 'display_name' => 'Listar Usuário'],
            ['name' => 'listar-funcao', 'display_name' => 'Listar Função'],
            ['name' => 'listar-permissao', 'display_name' => 'Listar Permissão'],
            ['name' => 'listar-administracao', 'display_name' => 'Listar Administração'],
            ['name' => 'alterar-menu', 'display_name' => 'Alterar Menu'],
            ['name' => 'alterar-usuario', 'display_name' => 'Alterar Usuário'],
            ['name' => 'alterar-funcao', 'display_name' => 'Alterar Função'],
            ['name' => 'alterar-permissao', 'display_name' => 'Alterar Permissão'],
            ['name' => 'alterar-administracao', 'display_name' => 'Alterar Administração'],
        ]);

        DB::table('menuacesso')->insert([
            ['text' => 'Administração', 'url' => '#', 'icon' => '', 'label' => '', 'label_color' => '', 'permission' => 'listar-administracao', 'parent' => 0],
            ['text' => 'Menu de Acesso', 'url' => 'menuacesso', 'icon' => 'user', 'label' => '', 'label_color' => '', 'permission' => 'listar-menu', 'parent' => 1],
            ['text' => 'Usuários', 'url' => 'usuario', 'icon' => 'user', 'label' => '', 'label_color' => '', 'permission' => 'listar-usuario', 'parent' => 1],
            ['text' => 'Funções', 'url' => 'role', 'icon' => 'user', 'label' => '', 'label_color' => '', 'permission' => 'listar-funcao', 'parent' => 1],
            ['text' => 'Permissões', 'url' => 'permission', 'icon' => 'user', 'label' => '', 'label_color' => '', 'permission' => 'listar-permissao', 'parent' => 1],
        ]);

        DB::table('permission_role')->insert([
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 1],
            ['permission_id' => 4, 'role_id' => 1],
            ['permission_id' => 5, 'role_id' => 1],
            ['permission_id' => 6, 'role_id' => 1],
            ['permission_id' => 7, 'role_id' => 1],
            ['permission_id' => 8, 'role_id' => 1],
            ['permission_id' => 9, 'role_id' => 1],
        ]);

        DB::table('role_user')->insert([
            ['user_id' => 1, 'role_id' => 1],
            ['user_id' => 2, 'role_id' => 2],
        ]);
    }
}
