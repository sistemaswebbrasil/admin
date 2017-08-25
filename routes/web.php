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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', 'LogErroController@grafico')->name('home');

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::resource('role', 'RoleController');
    Route::get('api/role', 'RoleController@grid')->name('role.ajax');
});

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::resource('permission', 'PermissionController');
    Route::get('api/permission', 'PermissionController@grid')->name('permission.ajax');
    Route::get('api/gerar', 'PermissionController@gerar')->name('permission.gerar.ajax');
});

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::resource('usuario', 'UsuarioController');
    Route::get('/profile', 'UsuarioController@profile')->name('usuario.profile');
    Route::post('changelocale', ['as' => 'changelocale', 'uses' => 'UsuarioController@changeLocale']);
    Route::get('api/usuario', 'UsuarioController@grid')->name('usuario.ajax');
});

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::resource('menuacesso', 'MenuAcessoController');
    Route::get('api/menuacesso', 'MenuAcessoController@grid')->name('menuacesso.ajax');
});

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::resource('logerro', 'LogErroController');
    Route::get('api/logerro', 'LogErroController@grid')->name('logerro.ajax');
    Route::get('api/logerrodetalhe/{id}', 'LogErroController@griddetalhe')->name('logerro.detalhe.ajax');
    Route::get('logerrografico', 'LogErroController@grafico')->name('logerro.grafico');
});

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::resource('cliente', 'ClienteController');
    Route::get('api/cliente', 'ClienteController@grid')->name('cliente.ajax');
});
