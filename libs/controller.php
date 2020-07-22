<?php

class Controller{

    function __construct(){
        $this->view = new View();
        $this->view->sesion = new Sesiones();


    }

    function loadModel($model){
        $url = 'model/'.$model.'.php';
        if(file_exists($url)){
            require_once $url;
            $this->model = new $model();
        }
    }
}

?>
