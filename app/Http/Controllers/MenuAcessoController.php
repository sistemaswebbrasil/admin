<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MenuAcesso;



class MenuAcessoController extends Controller
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
        $menuacessos = MenuAcesso::orderBy('id','DESC')->paginate(5);
        return view('menuacesso.index',compact('menuacessos'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Exibe o formulário
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus =  MenuAcesso::pluck('text', 'id');
        return view('menuacesso.create',compact('menus'));

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
            'url' => 'required',
        ]);

        MenuAcesso::create($request->all());
        return redirect()->route('menuacesso.index')
                        ->with('success','MenuAcesso created successfully');
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
        return view('menuacesso.show',compact('menuacesso'));
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
        $menus =  MenuAcesso::where('id', '<>', $id)->pluck('text','id');        
        $menus->prepend('Selecione',0);
        $icones = ['file','user','lock','share'];
        $collection = collect([['value' => 'red'],['value' => 'yellow'],['value' => 'aqua'],]);
        $iconesCores = $collection->pluck('value','value');

        



        return view('menuacesso.edit',compact('menuacesso','menus','icones','iconesCores'));
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
            'url' => 'required',
        ]);

        MenuAcesso::find($id)->update($request->all());
        return redirect()->route('menuacesso.index')
                        ->with('success','MenuAcesso updated successfully');
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
        return redirect()->route('menuacesso.index')
                        ->with('success','MenuAcesso deleted successfully');
    }
}
