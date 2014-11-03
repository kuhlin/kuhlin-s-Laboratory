<?php

/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 03-nov-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */

class CattreeController extends BaseController {

    public function mostrarCattree() {
        return View::make('categorias.lista');
    }

    public function get_node() {
        $params = Input::all();
        $rsltSQL = array('items' => Cattree::getNode($params));
        //Log::info($rsltSQL);
        $rslt = array();
        foreach ($rsltSQL['items'] as $v) {
            $rslt[] = array('id' => $v['id'], 'text' => $v['nm'], 'children' => ($v['rgt'] - $v['lft'] > 1));
        }
        return Response::json($rslt, 200);
    }

}

?>