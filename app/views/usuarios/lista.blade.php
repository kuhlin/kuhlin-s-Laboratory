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
**************************************** */
?>


@extends('layouts.master')
 
@section('sidebar')
     @parent
     Lista de usuarios
@stop
 
@section('content')
        <h1>
  Usuarios
      
    
  
</h1>
        {{ HTML::link('usuarios/nuevo', 'Crear Usuario'); }}
 
<ul>
  @foreach($usuarios as $usuario)
           <li>
    {{ HTML::link( 'usuarios/'.$usuario->id , $usuario->nombre.' '.$usuario->apellido ) }}
      
  </li>
          @endforeach
  </ul>
@stop