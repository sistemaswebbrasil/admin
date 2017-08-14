<?php

namespace App\Http\Controllers;

use App\Model\LogErro;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogErroController extends Controller
{
    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $logerros = LogErro::orderBy('id', 'DESC')->paginate(5);
        return view('logerro.index');
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function grid(Request $request)
    {
        // $logerros = LogErro::on('mysql-macae')->select(['cl_codigo', 'cl_nome', 'usuario', 'data', 'hora', 'estacao', 'ip', 'sistema', 'sql_rowid']);

// $reserves = DB::table('reserves')->selectRaw('*, count(*)')->groupBy('day');

        // $logerros = LogErro::on('mysql-macae')->select(['cl_codigo', 'cl_nome', 'count(*)'])->groupBy('cl_codigo');

        $logerros = DB::connection('mysql-macae')->table("suporte_log_erros_clientes")
            ->select(DB::raw("    cl_codigo,
    cl_nome,
    COUNT(*) AS total,
    SUM(IF(lido<>'S',1,0)) AS total_lidos"))
            ->orderBy("cl_nome")
            ->groupBy(DB::raw("cl_codigo"))
            ->get();

        //$user = User::on('user-shard1')->first()->create(array('name' => 'John'));

        return Datatables::of($logerros)->make(true);
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function grids(Request $request)
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
        return view('logerro.create');
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
            'cl_codigo' => 'required',
            'cl_nome'   => 'required',
        ]);

        $logerro = LogErro::create($request->all());
        return redirect()->route('logerro.index')->with('success', trans('geral.criadosucesso'));
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
            $logerro = LogErro::find($id);
            return view('logerro.show', compact('logerro'));
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
        $logerro     = LogErro::find($id);
        $permissions = LogErro::pluck('display_name', 'id');
        return view('logerro.edit', compact('logerro', 'permissions'));
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

        LogErro::find($id)->update($request->all());

        $logerro     = LogErro::find($id);
        $permissions = $request->input('permissions');
        $logerro->permissions()->sync($permissions);
        return redirect()->route('logerro.index')
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
        LogErro::find($id)->delete();
        return redirect()->route('logerro.index')->with('success', trans('geral.excluido'));
    }
}
