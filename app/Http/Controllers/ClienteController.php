<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Cliente;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ClienteController extends Controller
{
    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('cliente.index');
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function grid(Request $request)
    {
        $clientes = DB::connection('mysql-homologacao')->table("clientes")
            ->leftJoin('status', 'clientes.st_codigo', '=', 'status.st_codigo')
            ->select(DB::raw("cl_nome,cl_codigo,cl_cpf,cl_cidade,cl_fone,st_nome"))

            ->where('clientes.sql_deleted', '=', 'F')
            ->get();
        return Datatables::of($clientes)->make(true);
    }

    /**
     * Exibe o formulário
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
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

        Cliente::create($request->all());
        return redirect()->route('cliente.index')
            ->with('success', 'Cliente created successfully');
    }

    /**
     * Mostra a informação selecionada
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('cliente.show', compact('cliente'));
    }

    /**
     * Mostra o formulário de edição
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cl_codigo)
    {
        $cliente = Cliente::find($cl_codigo);
        // $tipopessoas = DB::connection('mysql-homologacao')->table("status")
        //     ->select(DB::raw("st_nome,st_codigo"))
        //     ->where('sql_deleted', '=', 'F')
        //     ->get();

        // $tipopessoas = DB::connection('mysql-homologacao')->table("status")->select('st_nome', 'st_codigo')->get();
        $status      = DB::connection('mysql-homologacao')->table("status")->pluck('st_nome', 'st_codigo');
        $tipopessoas = ['1' => 'Pessoa Física', '2' => 'Pessoa Jurídica'];
        //$tipopessoas = DB::connection('mysql-homologacao')->table("status")->pluck('st_nome', 'st_codigo');

        //Role::pluck('display_name', 'id');
        return view('cliente.edit', compact('cliente', 'tipopessoas', 'status'));
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
            'cl_codigo' => 'required',
            'name'      => 'required',
            'email'     => 'email',
            'cl_cpf'    => 'required',
        ]);

        Cliente::find($id)->update($request->all());
        return redirect()->route('cliente.index')
            ->with('success', 'Cliente updated successfully');
    }

    /**
     * Exclui os dados do banco de dados
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cliente::find($id)->delete();
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('cliente.index')
            ->with('success', 'Cliente deleted successfully');
    }
}
