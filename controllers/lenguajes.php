<?php
  Class Lenguajes extends Controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();

      if($this->view->sesion->getSesion('usuario') == -1){
        $this->view->redirect('');
      }
    }

    function render(){
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
          $this->view->redirect('inicio/index');
          die;
      }

      $this->loadModel('lenguajesModel');
      $this->view->data = $this->model->getListado();


      $this->view->render('lenguajes/lista');
    }

    function nuevo(){
      $data=[
        'idLenguaje' => getdate()[0],
        'nombre' => (isset($_POST['nombre'])) ? $_POST['nombre'] : ""
      ];

      $this->loadModel('lenguajesModel');
      if($this->model->getLenguaje($data['nombre']) != null){
        $this->render();
        echo "<script>swal('PSP', 'Este lenguaje ya se encuentra registrado', 'warning')</script>";
      }else{
        $this->model->nuevo($data);
        $this->render();
        echo "<script>swal('PSP', 'Se guardo exitosamente', 'success')</script>";
      }
    }

    function setLenguaje(){
      $data=[
        'idLenguaje' => (isset($_POST['idLenguaje'])) ? $_POST['idLenguaje'] : "",
        'nombre' => (isset($_POST['nombre'])) ? $_POST['nombre'] : ""
      ];
      $this->loadModel('lenguajesModel');
      if($this->model->getLenguaje($data['nombre']) != null){
        $this->render();
        echo "<script>swal('PSP', 'Este lenguaje ya se encuentra registrado', 'warning')</script>";
        die;
      }
      $this->model->setLenguaje($data);
      $this->render();
      echo "<script>swal('PSP', 'Se cambio exitosamente', 'success')</script>";
    }

    function eliminar($id){
      $this->loadModel('lenguajesModel');
      $this->model->eliminar($id[0]);
      $this->render();
      echo "<script>swal('PSP', 'Se elimino correctamente', 'success')</script>";
    }
  }
?>
