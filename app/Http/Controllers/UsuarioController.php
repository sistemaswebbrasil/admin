<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Role;
use Illuminate\Support\Facades\Storage;
use Auth;
use Image;


class UsuarioController extends Controller
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
        $roles =  Role::pluck('display_name', 'id');
        return view('usuario.create',compact('roles'));
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

        //User::create($request->all());

        $user = User::create($request->all());
        User::find($user);        
        $roles =$request->input('roles');         
        $user->roles()->attach($roles);

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
        $roles =  Role::pluck('display_name', 'id');
        return view('usuario.edit',compact('usuario','roles'));
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
        $user = User::find($id);
        $roles =$request->input('roles');        
        $user->roles()->sync($roles);

        //$path = $request->file('avatar')->store('avatars');


        if (request()->hasFile('avatar')) {
            $file = request()->file('avatar')->store('events');
            Events::Create($request->all() + ['image' => $file]);
        }else{
            $path = $request->file('avatar')->store('events');

        }        


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




    public function profile(){
        return view('profile', array('user' => Auth::user()) );
    }
    public function update_avatar(Request $request){
        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile', array('user' => Auth::user()) );
    }


}
