<?php
/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 20-sep-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */
?>
<html> 
    @section('vendor_css') 
    <!-- Core CSS - Include with every page -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('font-awesome-4.1.0/css/font-awesome.min.css') }}

    @show

    @section('custom_css') 
    <!-- SB Admin CSS - Include with every page -->
    {{ HTML::style('css/sb-admin-2.css') }}

    <!-- Custom css -->
<!--    {{ HTML::style('css/custom.css') }}-->
    @show
    <body>   
        @section('vendor_js') 
            <!-- Core Scripts - Include with every page -->
            {{ HTML::script('js/jquery-1.11.0.js') }}
            {{ HTML::script('js/bootstrap.min.js') }}
            {{ HTML::script('js/plugins/metisMenu/metisMenu.js') }}
            <!-- SB Admin Scripts - Include with every page -->
            {{ HTML::script('js/sb-admin-2.js') }}
            <!-- Custom script -->
<!--            {{ HTML::script('js/main.js') }}-->
        @show
                
        @yield('content')
        
        
                
        
    </body>
</html>
