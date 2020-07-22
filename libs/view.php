<?php

class View{

    function __construct(){
    }

    function render($nombre){
        require 'views/' . $nombre . '.php';
    }

    function redirect($nombre){
    	header('location:'.constant('URL') . $nombre);
    }


}

?>
