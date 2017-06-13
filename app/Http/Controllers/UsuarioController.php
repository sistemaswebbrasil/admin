<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;



class UsuarioController extends Controller
{
    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = User::orderBy('id','DESC')->paginate(5);
        return view('usuario.index',compact('usuarios'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Exibe o formulário
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
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
            'email' => 'email',
            'password' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('usuario.index')
                        ->with('success','User created successfully');
    }

    /**
     * Mostra a informação selecionada
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('usuario.show',compact('usuario'));
    }

    /**
     * Mostra o formulário de edição
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('usuario.edit',compact('usuario'));
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

        User::find($id)->update($request->all());
        return redirect()->route('usuario.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Exclui os dados do banco de dados
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuario.index')
                        ->with('success','User deleted successfully');
    }
}
