<?php

Route::group(['middleware' => ['web', 'auth', 'adminfrases'], 'prefix' => 'mgtraductor', 'namespace' => 'Modules\MgTraductor\Http\Controllers'], function()
{
    #Route::get('/', 'MgTraductorController@index');
    Route::get('/frases-ingles', 'AgregarFrasesEnInglesController@listFrases');
    Route::post('/save', 'AgregarFrasesEnInglesController@store');
    Route::get('/resultado', 'AgregarFrasesEnInglesController@resultado');
    Route::get('/delete/{id}', 'AgregarFrasesEnInglesController@destroy');
    Route::get('/update/{id}', 'AgregarFrasesEnInglesController@updateFrases');
    Route::get('/edit_frase_ingles/{id}', 'AgregarFrasesEnInglesController@edit');
    Route::post('/update_frase_ingles', 'AgregarFrasesEnInglesController@update');
    #
    Route::post('/save_traduccion_espanol', 'AgregarFrasesEnEspanolController@store');
    Route::post('/update_frase_espanol', 'AgregarFrasesEnEspanolController@update');
    Route::get('/delete_frase_espanol/{id}', 'AgregarFrasesEnEspanolController@destroy');
    Route::get('/edit_frase_espanol/{id}', 'AgregarFrasesEnEspanolController@edit');
    
});


Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'mgtraductor', 'namespace' => 'Modules\MgTraductor\Http\Controllers'], function()
{
    Route::get('/', 'MgTraductorController@index');    
    Route::post('/list_traduccion', 'AgregarFrasesEnEspanolController@listTraduccion');
    #Route::get('/get_frases_espanol', 'AgregarFrasesEnEspanolController@getFrasesEspanol');
});