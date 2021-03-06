<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\MenuAcesso;
use App\Model\Permission;
use Datatables;
use Illuminate\Http\Request;

class MenuAcessoController extends Controller
{

    /**
     * Insere o controle de autenticação no controller
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Auth->can('update');
        // \Auth::user()->can('sfsdf');

        // $action_name = Router>getCurrentRoute()->getName();
        // $this->authorize($request);

        // $this->authorize('update');

        $menuacessos = MenuAcesso::orderBy('text', 'ASC')->paginate(5);
        return view('menuacesso.index', compact('menuacessos'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function grid(Request $request)
    {
        $menuacessos = MenuAcesso::select(['id', 'text', 'url', 'created_at', 'updated_at']);
        return Datatables::of($menuacessos)
            ->editColumn('created_at', function ($menuacesso) {
                return $menuacesso->created_at ? $menuacesso->updated_at->format('d/m/y') : '';
            })
            ->editColumn('updated_at', function ($menuacesso) {
                if ($menuacesso->updated_at != null) {
                    return $menuacesso->updated_at->diffForHumans();
                }
            })
            ->make(true);
    }

    //return $user->created_at ? with(new Carbon($user->created_at))->format('m/d/Y') : '';

    /**
     * Exibe o formulário
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus      = MenuAcesso::pluck('text', 'id');
        $menuacesso = new MenuAcesso;
        $icones     = ['file', 'user', 'lock', 'share'];

        $collection   = collect([['value' => 'red'], ['value' => 'yellow'], ['value' => 'aqua']]);
        $iconesCores  = $collection->pluck('value', 'value');
        $permissions  = Permission::all();
        $label_colors = ['success', 'info', 'warning', 'danger'];
        $targets      = ['_self', '_blank'];

        return view('menuacesso.create', compact('menus', 'menuacesso', 'icones', 'iconesCores', 'permissions', 'label_colors', 'targets'));
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
            'text' => 'required',
        ]);

        MenuAcesso::create($request->all());
        return redirect()->route('menuacesso.index')
            ->with('success', 'MenuAcesso created successfully');
    }

    /**
     * Mostra a informação selecionada
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuacesso = MenuAcesso::find($id);
        return view('menuacesso.show', compact('menuacesso'));
    }

    /**
     * Mostra o formulário de edição
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuacesso = MenuAcesso::find($id);
        $menus      = MenuAcesso::where('id', '<>', $id)->pluck('text', 'id');
        $menus->prepend('Selecione', 0);
        $icones       = ['file', 'user', 'lock', 'share'];
        $collection   = collect([['value' => 'red'], ['value' => 'yellow'], ['value' => 'aqua']]);
        $iconesCores  = $collection->pluck('value', 'value');
        $permissions  = Permission::all();
        $label_colors = ['success', 'info', 'warning', 'danger'];
        $targets      = ['_self', '_blank'];

        return view('menuacesso.edit', compact('menuacesso', 'menus', 'icones', 'iconesCores', 'permissions', 'label_colors', 'targets'));
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
            'text' => 'required',
            // 'url'  => 'required',
            // 'icon' => 'required',
            // 'permission' => 'required',
        ]);

        MenuAcesso::find($id)->update($request->all());
        return redirect()->route('menuacesso.index')
            ->with('success', 'MenuAcesso updated successfully');
    }

/**
 * Exclui os dados do banco de dados
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function destroy($id)
    {
        MenuAcesso::find($id)->delete();
        // MenuAcesso::destroy($id);
        //

        $response["message"] = trans('geral.excluido');

        return \Response::json($response);

        // return redirect()->route('menuacesso.index')->with('success', 'MenuAcesso deleted successfully');
    }
}
