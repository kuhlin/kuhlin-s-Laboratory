<?php

/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 03-nov-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */
class Cattree extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $connection = 'sqlsrv';
    
    
    protected $table = 'vw_cattree';
    
    
    public function scopeGetNode($query, $params){
        if( array_key_exists("id", $params) ){
                $query = $query->where('pid', $params["id"] === '#' ? '999999' : $params["id"] );
            }
        return $query->get();
    }
}


?>
