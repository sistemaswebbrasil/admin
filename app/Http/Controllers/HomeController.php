<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $atendimentosArray = DB::connection('mysql-macae')->table("relacionamentos")
            ->select(DB::raw("rl_nome AS solicitante,count(*) AS total "))
            ->where('sql_deleted', '=', 'F')
            ->orderBy("rl_nome")
            ->groupBy(DB::raw("rl_nome"))
            ->get()->toArray();

        $atendtotal       = array_column($atendimentosArray, 'total');
        $atendsolicitante = array_column($atendimentosArray, 'solicitante');

        $atendimentostotal = DB::connection('mysql-macae')->table("relacionamentos")
            ->select(DB::raw("count(*) AS total "))
            ->where('sql_deleted', '=', 'F')
            ->where('rl_concluido', '=', 0)
            ->first();

        $errostotal = DB::connection('mysql-macae')->table("suporte_log_erros_clientes")
            ->select(DB::raw("count(*) AS total "))
            ->where('sql_deleted', '=', 'F')
            ->where('lido', '<>', 'S')
            ->first();

        // $errostotal = array_column($errosTotalArray, 'total');

        //select count(*) from relacionamentos where sql_deleted = 'F' and rl_concluido = 0
        //select count(*) from suporte_log_erros_clientes where sql_deleted = 'F' and lido = 'S'

        return view('home', compact('errostotal', 'atendimentostotal'))
            ->with('logerros', json_encode($logerrosArray, JSON_NUMERIC_CHECK))
            ->with('clientes', json_encode($clientes, JSON_NUMERIC_CHECK))
            ->with('errosapp', json_encode($errosapp, JSON_NUMERIC_CHECK))
            ->with('errosapplido', json_encode($errosapplido, JSON_NUMERIC_CHECK))
            ->with('errosappsis', json_encode($errosappsis, JSON_NUMERIC_CHECK))

            ->with('atendtotal', json_encode($atendtotal, JSON_NUMERIC_CHECK))

            ->with('atendsolicitante', json_encode($atendsolicitante, JSON_NUMERIC_CHECK));

        // return view('logerro.grafico');
    }
}
