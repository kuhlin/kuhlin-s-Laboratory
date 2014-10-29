<?php

/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 10-oct-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */

// Segundo modelo (Third Step MVC - eloquent ORM)
class Carbrands extends Eloquent {

    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'carbrands';
    
    public function carbrands() {
        return $this->hasMany('Carmodels');
    }

}

?>
