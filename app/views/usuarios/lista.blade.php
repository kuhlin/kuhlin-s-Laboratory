<?php
/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 19-sep-2014
 * Modifs:	
 * Description:  
 * Used in:	
  ~~~~~~ file info ~~~~~~ */
?>
<?
/*  First Step MVC) Linea 11 - 25 ************************
  <h1>
  Usuarios

  </h1>

  <ul>
  @foreach($usuarios as $usuario)
  Equivalente en Blade a <?php //foreach ($usuarios as $usuario) ?>
  <li>
  {{ $usuario->nombre.' '.$usuario->apellido }}
  </li>
  Equivalente en Blade a <?php //echo $usuario->nombre.' '.$usuario->apellido ?>
  @endforeach
  </ul>
 * *************************************** */
?>


@extends('layouts.master')

@section('sidebar')
@parent
Lista de usuarios
@stop

@section('vendor_css')
@parent 
{{ HTML::style('css/plugins/dataTables.bootstrap.css') }} 
@stop

@section('vendor_js') 
@parent 
{{ HTML::script('js/plugins/dataTables/jquery.dataTables.js') }} 
{{ HTML::script('js/plugins/dataTables/dataTables.bootstrap.js') }} 
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
{{ HTML::link('usuarios/nuevo', 'Crear Usuario'); }}

<!--<ul>
    @foreach($usuarios as $usuario)
    <li>
        {{ HTML::link( 'usuarios/'.$usuario->id , $usuario->nombre.' '.$usuario->apellido ) }}

    </li>
    @endforeach
</ul>-->
{{ Datatable::table()
    ->addColumn('nombre', 'apellido', 'created_at','Action')  
    ->setOptions('sPaginationType', array('simple_numbers'))
    //->setCallbacks('fnServerParams', 'function ( aoData ) {aoData.push( { "name": "params", "value": prepareJSONParams() } );}')
    ->setUrl(route('datatables'))
    ->render() }} 

@stop
