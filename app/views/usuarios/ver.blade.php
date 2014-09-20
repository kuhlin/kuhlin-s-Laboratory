<?php

/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 19-sep-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */
?>
@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de usuario
@stop
 
@section('content')
        {{ HTML::link('usuarios', 'Volver'); }}
        <h1>
  Usuario {{$usuario->id}}
      
</h1>
        
        {{ $usuario->nombre .' '.$usuario->apellido }}
        
<br />
        {{ $usuario->created_at}}
@stop
