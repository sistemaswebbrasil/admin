<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Permission;




class RoleController extends Controller
{
    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('role.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Exibe o formulário
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions =  Permission::pluck('display_name', 'id');
        return view('role.create',compact('permissions'));
    }

    /**
     * Grava os dados vindos do formulário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',            
            'display_name' => 'required',
        ]);

        //Role::create($request->all());
        //Role::permissions()->sync($request->get('permissions'));

        //$Role->permissions()->attach( $request->input('permissions') );

        //Role::create($request->all());

        Role::create($request)->all()->permissions()->attach($request);

        return redirect()->route('role.index')
                        ->with('success','Role created successfully');
    }

    /**
     * Mostra a informação selecionada
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view('role.show',compact('role'));
    }

    /**
     * Mostra o formulário de edição
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        //$permissions = Permission::lists('name', 'id');
        //$userList = App\User::pluck('name', 'id');
        $permissions =  Permission::pluck('display_name', 'id');
        //$role->Permissions()->attach('permission');
        //$roles = Role::pluck('display_name','id');
        //$user->roles()->attach($roleId);
        

        return view('role.edit',compact('role','permissions'));
    }

    /**
     * Atualiza os dados no banco
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email',
        ]);

        


        //$signature->users()->sync( $request->input('user_id') );
        //
        
        //Signature::create($values)->users()->attach($user_id);

       // Role::find($id)->update($request)->all()->permissions()->attach('user_id');



        //Role::permissions()->sync($request->get('permissions'));
        Role::find($id)->update($request->all());


        return redirect()->route('role.index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Exclui os dados do banco de dados
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return redirect()->route('role.index')
                        ->with('success','Role deleted successfully');
    }
}
