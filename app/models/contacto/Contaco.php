<?php

/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 30-sep-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */

class Contacto extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entradas';

    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'contacto';

    /**
     * Para que no guarde columnas, created_at y updated_at
     * 
     * @var bool 
     */
    public $timestamps = false;
    protected $fillable = array('phone', 'name', 'email', 'tipo', 'motivo', 'estado', 'origen', 'observaciones', 'start_date', 'end_date', 'servicio', 'operador', 'sexo', 'comentarios', 'submotivos');

    /*     * * Pagination ** */
    protected $perPage = 20;

    public function paginate($perPage) {
        $this->perPage = (int) $perPage;

        return $this;
    }

    //protected $users = Paginator::make($items, $totalItems, $perPage);
//        public function getByPage($page = 1, $limit = 10) {
//            $results = StdClass;
//            $results->page = $page;
//            $results->limit = $limit;
//            $results->totalItems = 0;
//            $results->items = array();
//
//            $users = $this->model->skip($limit * ($page - 1))->take($limit)->get();
//
//            $results->totalItems = $this->model->count();
//            $results->items = $users->all();
//
//            return $results;
//        }

    /*     * * End Pagination ** */

    /** Relación con el motivo * */
    public function motivo() {
        return $this->hasOne('Motivo', 'id', 'motivo');
    }

    /** Relación con el estado * */
    public function estado() {
        return $this->hasOne('Estado', 'id', 'estado');
    }

    /** Relación con el origen * */
    public function origen() {
        return $this->hasOne('Origen', 'id', 'origen');
    }

    /** Relación con el Servicio * */
    public function servicio() {
        return $this->hasOne('Servicio', 'id', 'servicio');
    }

    /** Relación con el tipo * */
    public function tipoLlamante() {
        return $this->hasOne('TipoLlamante', 'id', 'tipo');
    }

    /** Relación con los Comentarios * */
    public function comentarios() {
        return $this->hasMany('ComentarioContacto', 'id_entrada');
    }

    /** Relación con los submotivos * */
    public function submotivos() {
        return $this->belongsToMany('Submotivo', 'submotivos_entradas', 'id_entrada', 'id_submotivo');
    }

    /*     * * Consulta que devuelve los motivos con todos los datos * */

    public function scopeGetList($query, $params) {
        //print_r($params["estado"]);            
        if (array_key_exists("estado", $params)) {
            $query = $query->whereIn('estado', $params["estado"]);
        }
        $query = $query->with('motivo', 'estado', 'origen', 'servicio', 'tipoLLamante')->orderBy('start_date', 'DESC');

        if (array_key_exists("limit", $params)) {
            $query = $query->take(1000);
        }
        Log::error($query->get()->toArray());
        return $query->get()->toArray();
        //return ($this->perPage > 0) ? $query->paginate($this->perPage)->toArray()['data']  : $query->get()->toArray() ;
        //return $query->skip(10)->take(30)->get()->toArray();            
    }

    /*     * * Consulta que devuelve el informe de los contactos con el filtrado correspondiente * */

    public function scopeGetReport($query, $params) {
        if (array_key_exists('origen', $params) && $params['origen'] != 0) {
            $query = $query->where('origen', '=', $params['origen']);
        }
        if (array_key_exists('from', $params) && $params['from'] != '' && array_key_exists('to', $params) && $params['to'] != '') {
            $query = $query->whereBetween('start_date', array($params['from'], $params['to']));
        }
        if (array_key_exists('submotivo', $params) || array_key_exists('motivo', $params)) {
            $type = 'submotivos';
            $query = $query->where('motivo', '=', $params['motivo']);
            $column = 'submotivos_entradas.id_submotivo';
        } else {
            $type = 'motivo';
            $column = $type;
        }
        $query = $query->with('estado')->groupBy('estado');
        if (array_key_exists('submotivo', $params)) {
            $query = $query->join('submotivos_entradas', function($join) {
                        $join->on('id', '=', 'submotivos_entradas.id_entrada');
                    }
                    )
                    ->join('submotivos', function($join) {
                        $join->on('submotivos_entradas.id_submotivo', '=', 'submotivos.id');
                    }
                    )
                    ->where('submotivos.parent_id', '=', $params['submotivo'])
                    ->groupBy('submotivos_entradas.id_submotivo')
                    ->orderBy('submotivos_entradas.id_submotivo', 'ASC');
        } elseif (array_key_exists('motivo', $params)) {
            $query = $query->join('submotivos_entradas', function($join) {
                        $join->on('id', '=', 'submotivos_entradas.id_entrada');
                    }
                    )
                    ->join('submotivos', function($join) {
                        $join->on('submotivos_entradas.id_submotivo', '=', 'submotivos.id');
                    }
                    )
                    ->where('submotivos.parent_id', '=', null)
                    ->groupBy('submotivos_entradas.id_submotivo')
                    ->orderBy('submotivos_entradas.id_submotivo', 'ASC');
        } else {
            $query->with($type)
                    ->groupBy($type)
                    ->orderBy($type, 'ASC');
        }
        return $query->get(array('estado', $column, DB::raw('count(*) as count')))->toArray();
    }

    /** Validación del campo * */
    public function isValid($data) {
        $rules = array(
            'phone' => 'regex:/^\d{9}$/',
            'origen' => 'required',
            'servicio' => 'required',
            'tipo' => 'required',
            'motivo' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'date',
            'email' => 'email',
            'operador' => 'required'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    /*     * * Función para validar y salvar ** */

    public function validAndSave($data) {
        $errors = array();
        $data['operador'] = ( $this->id != null ) ? $this->operador : (( array_key_exists('current_operador', $data) ) ? $data['current_operador'] : null);
        $data['new'] = ( $this->id != null ) ? 0 : 1;
        if ($this->isValid($data)) {
            $data['end_date'] = ( $data['end_date'] != '' ) ? $data['end_date'] : null;
            if (array_key_exists('end_date', $data) && $data['end_date'] != null) {
                $data['estado'] = 3;
            } else if (array_key_exists('tramitando', $data)) {
                $data['estado'] = 2;
            } else {
                $data['estado'] = 1;
            }
            $data['submotivo'] = ( array_key_exists('submotivo', $data) ) ? $data['submotivo'] : array();
            $this->fill($data);
            if ($this->save()) {

                $this->submotivos()->sync($data['submotivo']);
                $comentario = new ComentarioContacto;
                $dataComentario = array('id_entrada' => $this->id, 'operador' => $data['current_operador'], 'comentario' => $data['comentario'], 'fecha' => date('Y-m-d H:i:s'));
                $comentario->validAndSave($dataComentario);

                $data['motivoInfo'] = Motivo::find($data['motivo']);
                $data['id'] = $this->id;
                Mail::send('emails.contacto.newContacto', $data, function($message) use ($data) {
                    $message->from('guias11811@11811.es', 'Contacto');
                    $message->to($data['motivoInfo']->mail, $data['motivoInfo']->name)->subject('[' . $data['motivoInfo']->name . "] " . $data['phone'] . " " . $data['email'] . " " . ( ( $data['new'] == 0 ) ? "UPDATE" : " NEW" ));
                });
            } else {
                array_push($errors, "Ha ocurrido un error en el sistema vuelva a intentarlo más tarde");
            }
        } else {
            $errors = $this->errors;
        }
        return $errors;
    }

}
