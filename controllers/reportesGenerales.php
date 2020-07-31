<?php

  class ReportesGenerales extends controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();
      if($this->view->sesion->getSesion('usuario') == -1){
          $this->view->redirect('dashboard');
      }else if($this->view->sesion->getSesion('usuario')[4] == 'programador' ){
        $this->view->redirect('');
      }
    }

    function render(){
      $this->loadModel('reportesModel');
      $this->view->data = $this->model->getData();

      $this->view->render('reportes/listado');
    }

    function reporte($cedula = 'nada'){
      if($cedula == 'nada'){
        $this->view->redirect('ReportesGenerales');
      }

      $this->loadModel('ReportesPersonModel');
      $this->view->data = $this->model->getData($cedula[0]);

      if($this->view->data == false){
        $this->view->redirect('ReportesGenerales');
      }

      $this->view->render('reportes/graficas');
      // echo "trabajando en ello, no acose :V $cedula[0] ";
    }
  }
?>
