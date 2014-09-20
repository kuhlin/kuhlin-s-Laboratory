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
     Formulario de usuario
@stop
 
@section('content')
        {{ HTML::link('usuarios', 'volver'); }}
        <h1>
  Crear Usuario
      
    
  
</h1>
        {{ Form::open(array('url' => 'usuarios/crear')) }}
            {{Form::label('nombre', 'Nombre')}}
            {{Form::text('nombre', '')}}
            {{Form::label('apellido', 'Apellido')}}
            {{Form::text('apellido', '')}}
            {{Form::submit('Guardar')}}
        {{ Form::close() }}
@stop
