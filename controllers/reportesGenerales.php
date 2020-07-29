<?php

  class ReportesGenerales extends controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();

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

      echo "trabajando en ello, no acose :V $cedula[0] ";
    }
  }
?>
