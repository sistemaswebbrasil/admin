<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\CriaNovaPermissao;
use App\Model\Permission;
use App\Model\Role;
use Datatables;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    /**
     * Insere o controle de autenticação no controller
     */
    public function __construct()
    {
        /**
         * Função que irá criar nova permissão se ela não existir e vinculará ao administrador
         */
        CriaNovaPermissao::verifica(['listar-funcoes', 'alterar-funcoes']);

        $this->middleware('ability:,listar-funcoes,alterar-funcoes', ['only' => ['index', 'show']]);
        $this->middleware('ability:,alterar-funcoes', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('role.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function grid(Request $request)
    {
        $roles = Role::select(['id', 'name', 'display_name', 'created_at', 'updated_at']);
        return Datatables::of($roles)
            ->editColumn('created_at', function ($roles) {
                return $roles->created_at ? $roles->updated_at->format('d/m/y') : '';
            })
            ->editColumn('updated_at', function ($roles) {
                if ($roles->updated_at != null) {
                    return $roles->updated_at->diffForHumans();
                }
            })
            ->make(true);
    }

    /**
     * Exibe o formulário
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::pluck('display_name', 'id');
        return view('role.create', compact('permissions'));
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
            'name'         => 'required',
            'display_name' => 'required',
        ]);

        $role = Role::create($request->all());
        Role::find($role);
        $permissions = $request->input('permissions');
        $role->permissions()->attach($permissions);

        return redirect()->route('role.index')->with('success', trans('geral.criadosucesso'));
    }

    /**
     * Mostra a informação selecionada
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!empty($id)) {
            // dd($id);
            // var_dump('asasas');
            $role = Role::find($id);
            return view('role.show', compact('role'));
        }
    }

    /**
     * Mostra o formulário de edição
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role        = Role::find($id);
        $permissions = Permission::pluck('display_name', 'id');
        return view('role.edit', compact('role', 'permissions'));
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
            'name'  => 'required',
            'email' => 'email',
        ]);

        Role::find($id)->update($request->all());

        $role        = Role::find($id);
        $permissions = $request->input('permissions');
        $role->permissions()->sync($permissions);
        return redirect()->route('role.index')
            ->with('success', trans('geral.atualizadosucesso'));
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
        return redirect()->route('role.index')->with('success', trans('geral.excluido'));
    }
}
