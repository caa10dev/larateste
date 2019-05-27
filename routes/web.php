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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth']);

Route::group( ['middleware' => ['auth'], 'namespace' => 'Settings', 'prefix' => 'settings'], function() {   
    Route::get('users/minha_conta', 'UserController@minhaConta')->name('users.minha_conta');
    Route::put('users/update/minha_conta', 'UserController@updateMinhaConta')->name('users.update.minha_conta');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    //Route::get('/filiais', 'EmpresasController@filiais')->name('empresas.filiais');
});


Route::group( ['middleware' => ['auth'], 'namespace' => 'Util', 'prefix' => 'util'], function() {
	//Util
	Route::get('ufs', ['as' => 'util.ufs', 'uses' => 'UtilController@ufs']);
	Route::get('cidades/{uf}', ['as' => 'util.ufs', 'uses' => 'UtilController@cidades']);
	Route::get('cep/{cep}', ['as' => 'util.cep', 'uses' => 'UtilController@cep']);
	//Route::post('parametrosReceita', ['as' => 'util.parametrosReceita', 'uses' => 'UtilController@parametrosReceita']);
	//Route::post('consultaReceita', ['as' => 'util.consultaReceita', 'uses' => 'UtilController@consultaReceita']);
});