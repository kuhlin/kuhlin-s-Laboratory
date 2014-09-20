<?php

/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 19-sep-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */

// Primer modelo (First Step MVC)
class Usuario extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'usuarios';
    protected $fillable = array('nombre', 'apellido'); // (Second Step MVC) Especificamos los campos a actualizar
}
?>
