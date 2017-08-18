<?php

namespace App\Http\Controllers;

use App\Model\LogErro;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * Exibe Gráficos
     *
     * @return \Illuminate\Http\Response
     */
    public function grafico(Request $request)
    {
        // Route::get('logerrografico', 'LogErroController@grafico')->name('logerro.grafico');
        //

        $logerros = DB::connection('mysql-macae')->table("suporte_log_erros_clientes")
            ->select(DB::raw("cl_nome AS cliente,count(*) AS total "))
            ->where('sql_deleted', '=', 'F')
            ->orderBy("cl_nome")
            ->groupBy(DB::raw("cl_codigo"))
            ->get()->toArray();

        // Log::info($logerros);

        $logerrosArray = array_column($logerros, 'total');
        $clientes      = array_column($logerros, 'cliente');

        $logerrosApp = DB::connection('mysql-macae')->table("suporte_log_erros_clientes")
            ->select(DB::raw("SUBSTRING_INDEX(sistema, '(', 1) as sistema,
                COUNT(*) AS total,
                SUM(IF(lido<>'S',1,0)) AS total_lido"))
            ->where('sql_deleted', '=', 'F')
            ->orderBy("cl_nome")
            ->groupBy(DB::raw("SUBSTRING_INDEX(sistema, '(', 1)"))
            ->get()->toArray();

        $errosapp     = array_column($logerrosApp, 'total');
        $errosapplido = array_column($logerrosApp, 'total_lido');
        $errosappsis  = array_column($logerrosApp, 'sistema');

        Log::info($errosappsis);

// SELECT
        //     SUBSTRING_INDEX(sistema, '(', 1) as sistema,
        //     COUNT(*) AS total,
        //     SUM(IF(lido<>'S',1,0)) AS total_lidos
        // FROM
        //     suporte_log_erros_clientes
        // WHERE sql_deleted = 'F'
        // GROUP BY SUBSTRING_INDEX(sistema, '(', 1)
        // ORDER BY sistema

        // Log::info($logerros);
        // Log::info('Clientes: ' . $clientes);

        // $clientes = DB::connection('mysql-macae')->table("suporte_log_erros_clientes")
        //     ->select(DB::raw("distinct cl_nome as cliente "))
        //     ->orderBy("cl_nome")
        //     ->get()->toArray();
        // $clientes = array_column($clientes, 'cliente');

        // $viewer = View::select(DB::raw("SUM(numberofview) as count"))
        //     ->orderBy("created_at")
        //     ->groupBy(DB::raw("year(created_at)"))
        //     ->get()->toArray();
        // $viewer = array_column($viewer, 'count');

        // $click = Click::select(DB::raw("SUM(numberofclick) as count"))
        //     ->orderBy("created_at")
        //     ->groupBy(DB::raw("year(created_at)"))
        //     ->get()->toArray();
        // $click = array_column($click, 'count');

        return view('logerro.grafico')
            ->with('logerros', json_encode($logerrosArray, JSON_NUMERIC_CHECK))
            ->with('clientes', json_encode($clientes, JSON_NUMERIC_CHECK))
            ->with('errosapp', json_encode($errosapp, JSON_NUMERIC_CHECK))
            ->with('errosapplido', json_encode($errosapplido, JSON_NUMERIC_CHECK))
            ->with('errosappsis', json_encode($errosappsis, JSON_NUMERIC_CHECK));

        // return view('logerro.grafico');
    }

    // $logerrosAppArray = array_column($logerros, 'total');
    // $logerrosLidosArray = array_column($logerros, 'total_lido');
    // $logerrosSisArray = array_column($logerros, 'sistema');

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function grid(Request $request)
    {
        $logerros = DB::connection('mysql-macae')->table("suporte_log_erros_clientes")
            ->select(DB::raw("    cl_codigo,cl_nome,COUNT(*) AS total,SUM(IF(lido<>'S',1,0)) AS total_lidos"))
            ->where('sql_deleted', '=', 'F')

            ->orderBy("cl_nome")
            ->groupBy(DB::raw("cl_codigo"))
            ->get();

        return Datatables::of($logerros)->make(true);
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function griddetalhe(Request $request, $id)
    {
        $logerros = DB::connection('mysql-macae')
            ->select('select ip,usuario,estacao,data,hora,sistema,lido,erro from suporte_log_erros_clientes where cl_codigo = ? and sql_deleted = \'F\' ', [$id]);

        return Datatables::of($logerros)->make(true);
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
            return view('logerro.show', compact('id'));
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
