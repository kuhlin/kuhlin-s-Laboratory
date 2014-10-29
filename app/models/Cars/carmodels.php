<?php

/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 29-oct-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */

class Carmodels extends Eloquent {

    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'carmodels';
    public function carmodels() {
        return $this->belongsTo('Carbrands');
    }

}

?>
