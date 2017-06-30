<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::resource('usuario','UsuarioController');

//Route::group(['middleware' => ['ability:admin,listar-funcoes']], function() {
//Route::group(function() {
	Route::resource('role','RoleController');

	// Route::get('/role', 'RoleController@index')->name('role.index');
	// Route::get('/role/create',['middleware' => ['ability:criar-funcao']], 'RoleController@create')->name('role.create');
	// Route::post('/role', 'RoleController@store')->name('role.store');
	// Route::get('/role/{id}', 'RoleController@show')->name('role.show');
	// Route::get('/role/{id}/edit', 'RoleController@edit')->name('role.edit');
	// Route::put('/role/{id}', 'RoleController@update')->name('role.update');
	// Route::delete('/role/{id}', 'RoleController@destroy')->name('role.destroy');

//});	
//'middleware' => ['ability:admin|administrador,listar-funcoes|edit-user,true']


Route::group(['middleware' => ['ability:admin,listar-permissoes']], function() {
	Route::resource('permission','PermissionController');
});

//Route::group(['prefix' => 'usuario','middleware' => ['role:administrator|admin']], 
Route::group(['middleware' => ['ability:admin,listar-usuarios']], function() {
    //Route::get('usuario', 'UsuarioController@index');
    Route::resource('usuario','UsuarioController');
    Route::get('/profile', 'UsuarioController@profile')->name('usuario.profile');
});

Route::group(['middleware' => ['ability:admin,listar-itens-menu-acesso']], function() {    
    Route::resource('menuacesso','MenuAcessoController');
    //'middleware' => ['ability:admin|owner,create-post|edit-user,true']
});


//Route::get('profile', 'UsuarioController@profile');
//Route::post('profile', 'UsuarioController@update_avatar');


// public function index(Request $request)
// public function create()
// public function store(Request $request)
// public function show($id)
// public function edit($id)
// public function update(Request $request, $id)
// public function destroy($id)

// GET	/photo	index	photo.index
// GET	/photo/create	create	photo.create
// POST	/photo	store	photo.store
// GET	/photo/{photo}	show	photo.show
// GET	/photo/{photo}/edit	edit	photo.edit
// PUT/PATCH	/photo/{photo}	update	photo.update
// DELETE	/photo/{photo}	destroy	photo.destroy

