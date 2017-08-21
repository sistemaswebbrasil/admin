<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
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
        $permissions = Permission::orderBy('id', 'DESC')->paginate(5);
        return view('permission.index', compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function grid(Request $request)
    {
        $permissions = Permission::select(['id', 'name', 'display_name', 'created_at', 'updated_at']);
        return Datatables::of($permissions)
            ->editColumn('created_at', function ($permission) {
                return $permission->created_at ? $permission->updated_at->format('d/m/y') : '';
            })
            ->editColumn('updated_at', function ($permission) {
                if ($permission->updated_at != null) {
                    return $permission->updated_at->diffForHumans();
                }
            })
            ->make(true);
    }

    // Route::get('api/gerar', 'PermissionController@gerar')->name('permission.gerar.ajax');

    /**
     * Gerar as permissões de apps novos que ainda não consta na tabela permission
     *
     * @return \Illuminate\Http\Response
     */
    public function gerar(Request $request)
    {
        $routes   = Route::getRoutes();
        $contador = 0;

        foreach ($routes as $value) {
            //echo $value->getPath();
            // Log::info('URI :' . print_r($value->uri(), true));
            //

            if (!empty($value->getName())) {
                $permissaoExiste = Permission::where(['name' => $value->getName()])->count();
                // DB::table('permission')->where('name', '=', $value->getName() )->get();
                if ($permissaoExiste == 0) {
                    // Permission::create($params); //($request->all());

                    $permission = Permission::create([
                        'name'         => $value->getName(),
                        'display_name' => $value->getName(),
                        'description'  => 'Permissão Gerada Apartir do Botão Atualizar Permissões',
                    ]);
                    $contador += 1;
                }
            }

            Log::info('getName :' . print_r($value->getName(), true));
            // Log::info('getPrefix :' . print_r($value->getPrefix(), true));
            // Log::info('getActionMethod :' . print_r($value->getActionMethod(), true));
        };

        return response()->json([
            'status' => $contador . ' novas permissões cadastradas ! ',
        ]);
    }

    /**
     * Exibe o formulário
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.create');
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

        Permission::create($request->all());
        return redirect()->route('permission.index')
            ->with('success', 'Permission created successfully');
    }

    /**
     * Mostra a informação selecionada
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        return view('permission.show', compact('permission'));
    }

    /**
     * Mostra o formulário de edição
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permission.edit', compact('permission'));
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

        Permission::find($id)->update($request->all());
        return redirect()->route('permission.index')
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Exclui os dados do banco de dados
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Permission::find($id)->delete();
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')
            ->with('success', 'Permission deleted successfully');
    }

}
