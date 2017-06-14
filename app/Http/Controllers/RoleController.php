<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Permission;




class RoleController extends Controller
{
    
    /**
     * Insere o controle de autenticação no controller
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


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

        $role = Role::create($request->all());
        Role::find($role);        
        $permissions =$request->input('permissions');         
        $role->permissions()->attach($permissions);

        return redirect()->route('role.index')->with('success','Role created successfully');
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
        $permissions =  Permission::pluck('display_name', 'id');
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

        Role::find($id)->update($request->all());
        
        $role = Role::find($id);
        $permissions =$request->input('permissions');        
        $role->permissions()->sync($permissions);
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
