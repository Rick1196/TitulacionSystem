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
Route::get('registro','Auth\RegisterController@registerLink')->name('registro');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin/home');
    });
    Route::get('/admin/sinodales', function () {
        return view('admin/sinodales');
    });
    Route::get('/tesista',function(){
        return view('tesista/home');
    });

    Route::get('/tesista/app_con',function(){
        return view('tesista/app_con');
    });
    Route::get('/tesista/exp_lab',function(){
        return view('tesista/exp_lab');
    });
    Route::get('/tesista/rep_aut',function(){
        return view('tesista/rep_aut');
    });
    Route::get('/tesista/rep_res',function(){
        return view('tesista/rep_res');
    });
    Route::get('/tesista/tesis',function(){
        return view('tesista/tesis');
    });
    Route::get('/tesista/tesina',function(){
        return view('tesista/tesina');
    });
    Route::get('/tesista/ensayo',function(){
        return view('tesista/ensayo');
    });
    Route::get('/tesista/articulo',function(){
        return view('tesista/articulo');
    });

    Route::get('titulacion/inicio','ProtocolosController@protocolos_pendientes')->name('titulacion.inicio');
    Route::get('sinodales/inicio','ReportesController@misRevisiones')->name('sinodales.inicio');


    Route::get('/admin/tesistas','TesistasController@tesistasCrud')->name('admin.tesistas');
    Route::get('/admin/sinodales','SinodalesController@SinodalesCrud')->name('admin.sinodales');
    Route::resources([
        'tesistas' => 'TesistasController',
        'sinodales' => 'SinodalesController',
        'areas' => 'AreasController',
        'protocolos' => 'ProtocolosController',
        'reportes' => 'ReportesController'
    ]);
    Route::delete('sinodales/{sinodal}', 'SinodalesController@destroy')->name('sinodales.dest');
    //registro de protocolos
    Route::post('postArticulo', 'ProtocolosController@postArticulo');
    Route::post('postAppCon', 'ProtocolosController@postAppCon');
    Route::post('postEnsayo', 'ProtocolosController@postEnsayo');
    Route::post('postExpLab', 'ProtocolosController@postExpLab');
    Route::post('postRepAut', 'ProtocolosController@postRepAut');
    Route::post('postResInv', 'ProtocolosController@postResInv');
    Route::post('postTesina', 'ProtocolosController@postTesina');
    Route::post('postTesis', 'ProtocolosController@postTesis');
    
    Route::post('postFolio', 'ProtocolosController@asignar');

    Route::get('tesista/protocolos_listar/{usr}','ProtocolosController@protocolos_listar')->name('protocolos.listar');
    Route::get('tesista_info/{id}','AdminsController@getTesista');
    Route::get('student_info/{id}','TesistasController@getTesista');
    Route::get('sinodal_info/{id}','AdminsController@getSinodal');
    Route::get('get_carreras', 'AdminsController@getCarreras');
    Route::put('tesista_put_cascade','TesistasController@updateCascade');
    Route::put('sinodal_put_cascade','SinodalesController@updateCascade');

});

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth/login');
    });
});
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
