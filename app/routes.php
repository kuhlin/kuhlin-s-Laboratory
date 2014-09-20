<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::to('usuarios');
});
//User defined route, dige: 
Route::get('usuarios', array('uses' => 'UsuariosController@mostrarUsuarios'));

// (Second Step MVC)
Route::get('usuarios/nuevo', array('uses' => 'UsuariosController@nuevoUsuario'));

// (Second Step MVC) 
Route::post('usuarios/crear', array('uses' => 'UsuariosController@crearUsuario'));
// esta ruta es a la cual apunta el formulario donde se introduce la información del usuario
// como podemos observar es para recibir peticiones POST

// (Second Step MVC) 
Route::get('usuarios/{id}', array('uses'=>'UsuariosController@verUsuario'));
// esta ruta contiene un parámetro llamado {id}, que sirve para indicar el id del usuario que deseamos buscar
// este parámetro es pasado al controlador, podemos colocar todos los parámetros que necesitemos
// solo hay que tomar en cuenta que los parámetros van entre llaves {}
// si el parámetro es opcional se colocar un signo de interrogación {parámetro?}