<?php

/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 19-sep-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */

class UsuariosController extends BaseController {

    /**
     * Mustra la lista con todos los usuarios (First Step MVC)
     */
    public function mostrarUsuarios() {
        $usuarios = Usuario::all();

        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array

        return View::make('usuarios.lista', array('usuarios' => $usuarios));

        // El método make de la clase View indica cual vista vamos a mostrar al usuario 
        //y también pasa como parámetro los datos que queramos pasar a la vista. 
        // En este caso le estamos pasando un array con todos los usuarios
    }

    public function getDatatable() {
        /*
          return Datatable::collection(
          Usuario::all(
          array('id', 'nombre', 'apellido', 'created_at')
          )
          )
          ->showColumns('id'.'aa', 'nombre', 'apellido', 'created_at')
          ->searchColumns('nombre', 'apellido', 'created_at')
          ->orderColumns('id', 'nombre', 'apellido', 'created_at')
          ->make();
         */
        return Datatable::query(DB::table('usuarios'))
                        ->showColumns('nombre', 'apellido', 'created_at')
                        ->addColumn('dropdown', function ( $model ) {
                            return '<a href="' . URL::to('usuarios/' . $model->id) . '"> <i class=" btn btn-success fa fa-folder-open-o"></i></a>
                                    <a href="' . URL::to('usuarios/' . $model->id . '/edit') . '"> <i class="btn btn-info fa fa-pencil-square-o"></i></a>
                                    <a class="js-confirm" href="' . URL::to('usuarios/' . $model->id . '/destroy') . '"> <i class="btn btn-danger fa fa-trash-o"></i></a>';
                        })
                        ->searchColumns('nombre', 'apellido', 'created_at')
                        ->orderColumns('nombre', 'apellido', 'created_at')
                        ->make();
    }

    /**
     * Muestra formulario para crear Usuario (Second Step MVC)
     */
    public function nuevoUsuario() {
        return View::make('usuarios.crear');
    }

    /**
     * Crear el usuario nuevo  (Second Step MVC)
     */
    public function crearUsuario() {
        Usuario::create(Input::all());
        // el método create nos permite crear un nuevo usuario en la base de datos, este método es proporcionado por Laravel
        // create recibe como parámetro un arreglo con datos de un modelo y los inserta automáticamente en la base de datos
        // en este caso el arreglo es la información que viene desde un formulario y la obtenemos con el metido Input::all()

        return Redirect::to('usuarios');
        // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios
    }

    /**
     * Ver usuario con id (Second Step MVC)
     */
    public function verUsuario($id) {
        // en este método podemos observar como se recibe un parámetro llamado id
        // este es el id del usuario que se desea buscar y se debe declarar en la ruta como un parámetro

        $usuario = Usuario::find($id);
        // para buscar al usuario utilizamos el metido find que nos proporciona Laravel
        // este método devuelve un objete con toda la información que contiene un usuario

        return View::make('usuarios.ver', array('usuario' => $usuario));
    }

}

?>
