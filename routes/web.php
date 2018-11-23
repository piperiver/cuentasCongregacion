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
Route::group(['middleware' => 'auth'], function ()
{
  Route::get('/', function () {
      return redirect(route('home'));
  });

  Route::get('carpeta/{id}', 'CongregacionController@desplegarVistaCarpeta');
  Route::post('delCarpeta/', 'CongregacionController@delCarpeta');
  Route::get('congregacion/{id}', 'CongregacionController@desplegarVistaCongregacion');
  Route::post('calculos/guardarCarpeta', 'CongregacionController@guardarCarpeta');
  Route::post('carpeta/calcularInicioMes', 'CongregacionController@calcularInicioMes');
  Route::post('Recibo/delRecibo', 'CongregacionController@delRecibo');
  Route::post('Recibo/addRecibo', 'CongregacionController@addRecibo');
  Route::get('verpruebaPDF/{id}', 'CongregacionController@verHtmlPdf');
  Route::get('hojaCuentas/{id}', 'CongregacionController@hojadeCuentas');
  Route::get('informeMensual/{id}', 'CongregacionController@informeMensual');
  Route::get('Remesa/{id}', 'CongregacionController@remesa');
  Route::get('usuarios', 'UserController@usuarios');
  Route::post('usuario/add', 'UserController@addUser');
  Route::post('usuario/upd', 'UserController@updateUser');
  Route::post('usuario/del', 'UserController@delUser');
  Route::post('usuario/permisos', 'UserController@permisos');
  Route::get('pruebaPermisos', 'Permisos_userController@permisoParaSeguir');
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('migrarFechaCompuesta', 'CongregacionController@migrarFechaCompuesta');

});

Auth::routes();
