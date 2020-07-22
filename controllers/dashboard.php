<?php
  class Dashboard extends Controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();

      if($this->view->sesion->getSesion('usuario') == -1){
        $this->view->redirect('');
      }

    }

    function render(){
      if($this->view->sesion->getSesion('usuario')[4] == 'administrador'){
        $this->view->redirect('proyectos');
      }else{
        $this->view->redirect('gestionProyecto');
      }

    }

  }
?>
