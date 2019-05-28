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
Route::group(['middleware' => ['web'], 'prefix' => 'incidents','ctrl'=>'Incidents'], function()
{

    Route::get('/', 'IncidentsController@index')->name('incidents.index');
    Route::get('/index', 'IncidentsController@index')->name('incidents.index');
    Route::get('/create', 'IncidentsController@create')->name('incidents.create');
    Route::get('/{id}/edit', 'IncidentsController@edit')->name('incidents.edit');
    Route::post('/store', 'IncidentsController@store')->name('incidents.store');
    Route::post('/update', 'IncidentsController@update')->name('incidents.update');
    Route::delete('/destroy', 'IncidentsController@destroy')->name('incidents.destroy');
});
