<?php

class Gestion{

    function __construct(){
    }

    function render($nombre){
        require 'gestion/' . $nombre . '.php';
    }
    
    function redirect($nombre){
    	header('location:'.constant('URL') . $nombre);
    }


}

?>
