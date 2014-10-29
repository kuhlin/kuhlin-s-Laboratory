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

/** Logging shit **/
$logFile = 'laravel.log';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

$path = storage_path().'/logs/query.log';

App::before(function($request) use($path) {
    $start = PHP_EOL.'=| '.$request->method().' '.$request->path().' |='.PHP_EOL;
  File::append($path, $start);
});

Event::listen('illuminate.query', function($sql, $bindings, $time) use($path) {
    // Uncomment this if you want to include bindings to queries
    $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
    $sql = vsprintf($sql, $bindings);
    $time_now = (new DateTime)->format('Y-m-d H:i:s');;
    $log = $time_now.' | '.$sql.' | '.$time.'ms'.PHP_EOL;
  File::append($path, $log);
});

// Display all SQL executed in Eloquent

if (Config::get('database.log', false))
{           
    Event::listen('illuminate.query', function($query, $bindings, $time, $name)
    {
        $data = compact('bindings', 'time', 'name');

        // Format binding data for sql insertion
        foreach ($bindings as $i => $binding)
        {   
            if ($binding instanceof \DateTime)
            {   
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            }
            else if (is_string($binding))
            {   
                $bindings[$i] = "'$binding'";
            }   
        }       

        // Insert bindings into query
        $query = str_replace(array('%', '?'), array('%%', '%s'), $query);
        $query = vsprintf($query, $bindings); 

        Log::info($query, $data);
    });
}



Route::get('/', function() {
    //Set the default startup page
    return Redirect::to('api/dropdown');
});
//User defined route, dige: 
////Route::get('usuarios', array('uses' => 'UsuariosController@mostrarUsuarios'));

// (Second Step MVC)
////Route::get('usuarios/nuevo', array('uses' => 'UsuariosController@nuevoUsuario'));

// (Second Step MVC) 
////Route::post('usuarios/crear', array('uses' => 'UsuariosController@crearUsuario'));
// esta ruta es a la cual apunta el formulario donde se introduce la información del usuario
// como podemos observar es para recibir peticiones POST

// (Second Step MVC) 
////Route::get('usuarios/{id}', array('uses' => 'UsuariosController@verUsuario'));
// esta ruta contiene un parámetro llamado {id}, que sirve para indicar el id del usuario que deseamos buscar
// este parámetro es pasado al controlador, podemos colocar todos los parámetros que necesitemos
// solo hay que tomar en cuenta que los parámetros van entre llaves {}
// si el parámetro es opcional se colocar un signo de interrogación {parámetro?}

// Server side Pagining
//Route::resource('users', 'UsersController');
////Route::get('datatables', array('as'=>'datatables', 'uses'=>'UsuariosController@getDatatable'));


Route::get('api/dropdown', function(){
  $input = Input::get('option');
	$carbrands = Carbrands::g($input);
	$carmodels = $carbrands->carmodels();
	return Response::Carbrands($carmodels->get(['id','name']));
});