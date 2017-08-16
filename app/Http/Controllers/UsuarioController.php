<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\User;
use Auth;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Session;

class UsuarioController extends Controller
{
    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = User::orderBy('id', 'DESC')->paginate(5);
        return view('usuario.index', compact('usuarios'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Exibe uma lista
     *
     * @return \Illuminate\Http\Response
     */
    public function grid(Request $request)
    {
        $usuarios = User::select(['id', 'name', 'email', 'created_at', 'updated_at']);
        return Datatables::of($usuarios)
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? $user->updated_at->format('d/m/y') : '';
            })
            ->editColumn('updated_at', function ($user) {
                if ($user->updated_at != null) {
                    return $user->updated_at->diffForHumans();
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
        $roles     = Role::pluck('display_name', 'id');
        $titulo    = 'Criar novo usuário';
        $languages = \Config::get('app.locales');
        $skins     = \Config::get('adminlte.skins');
        $usuario   = new User();
        return view('usuario.create', compact('roles', 'titulo', 'languages', 'skins', 'usuario'));
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
            'name'                  => 'required',
            //'name'                  => 'required',
            //trans('usuario.email')  => 'email',
            'email'                 => 'email',
            'avatar'                => 'mimes:jpeg,png,jpg,gif,svg',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $params             = $request->except(['avatar']); //$request->all();
        $params['password'] = bcrypt($request->input('password'));

        $user = User::create($params); //($request->all());
        User::find($user);
        $roles = $request->input('roles');
        $user->roles()->attach($roles);

        if (request()->hasFile('avatar')) {
            $nomeArquivo = 'usuario_' . str_pad($user->id, 10, "0", STR_PAD_LEFT);
            $request->file('avatar')->move(public_path() . '/usuarios/', $nomeArquivo);
            $arquivo = '/usuarios/' . $nomeArquivo;
            $user->update(['avatar' => $arquivo]);
        }
        return redirect()->route('usuario.index')
            ->with('success', trans('geral.criadosucesso'));
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
        return view('usuario.show', compact('usuario'));
    }

    /**
     * Mostra o formulário de edição
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario   = User::find($id);
        $roles     = Role::pluck('display_name', 'id');
        $titulo    = 'Editar o Usuário ' . $id;
        $languages = \Config::get('app.locales');
        $skins     = ['blue', 'black', 'purple', 'yellow', 'red', 'green'
            , 'blue-light', 'purple-light', 'purple-light'];

        return view('usuario.edit', compact('usuario', 'roles', 'titulo', 'languages', 'skins'));
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
        //$request->user()->id
        $this->validate($request, [
            'name'                  => 'required',
            'email'                 => 'email',
            'avatar'                => 'mimes:jpeg,png,jpg,gif,svg',
            'new_password'          => 'same:password_confirmation',
            'password_confirmation' => 'same:new_password',
        ]);

        $usuario = User::find($id);
        $params  = $request->all(); //$request->except(['avatar']); //$request->all();

        if (request()->hasFile('avatar')) {
            $nomeArquivo = 'usuario_' . str_pad($id, 10, "0", STR_PAD_LEFT);
            $request->file('avatar')->move(public_path() . '/usuarios/', $nomeArquivo);
            $arquivo          = '/usuarios/' . $nomeArquivo;
            $params['avatar'] = $arquivo;
        }

        if (!empty($request->input('new_password'))) {
            $params['password'] = bcrypt($request->input('new_password'));
            $usuario->update($params);
            return redirect()->route('home')->with('success', trans('geral.usuariosenhasucesso'));
        }

        $usuario->update($params);
        if ($id == Auth::user()->id) {
            $locale = $request->input('language');
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        return redirect()->route('usuario.index')->with('success', trans('geral.atualizadosucesso'));
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

        $arquivo = public_path() . '/usuarios/usuario_' . str_pad($id, 10, "0", STR_PAD_LEFT);

        if (\File::exists($arquivo)) {
            unlink($arquivo);
        }

        return redirect()->route('usuario.index')
            ->with('success', 'User deleted successfully');
    }

    public function profile()
    {
        $usuario   = Auth::user();
        $languages = \Config::get('app.locales');
        $skins     = \Config::get('adminlte.skins');
        return view('usuario.profile', compact('usuario', 'languages', 'skins'));
    }
}
