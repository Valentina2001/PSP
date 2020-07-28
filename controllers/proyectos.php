<?php
  Class Proyectos extends Controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();
      if($this->view->sesion->getSesion('usuario') == -1){
        $this->view->redirect('');
      }
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
            $this->view->redirect('dashboard');
      }
    }


    function render(){
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
          $this->view->redirect('inicio/index');
          die;
      }

      $this->loadModel('proyectosModel');
      $this->view->data = $this->model->getListado();

      $this->loadModel('medidasModel');
      $this->view->listMedidas = $this->model->getListado();

      $this->loadModel('procesosModel');
      $this->view->listProcesos = $this->model->getListado();

      $this->loadModel('lenguajesModel');
      $this->view->listLenguajes = $this->model->getListado();

      $this->view->render('proyectos/lista');
    }
    function crear(){
        $this->loadModel('proyectosModel');

        $data = [
          'idProyecto' => (isset($_POST['idProyecto'])) ? $_POST['idProyecto'] :  "",
          'nombre' => (isset($_POST['nombre'])) ? $_POST['nombre'] :  "",
          'idProceso' => (isset($_POST['idProceso'])) ? $_POST['idProceso'] :  "",
          'idMedida' => (isset($_POST['idMedida'])) ? $_POST['idMedida'] :  "",
          'descripcion' => (isset($_POST['descripcion'])) ? $_POST['descripcion'] :  "",
          'fechaIn' => (isset($_POST['fechaIn'])) ? $_POST['fechaIn'] :  "",
          'fechaOut' => (isset($_POST['fechaOut'])) ? $_POST['fechaOut'] :  "",
          'idLenguaje' => (isset($_POST['idLenguaje'])) ? $_POST['idLenguaje'] :  "",
          'cedulaAdministrador' => $this->view->sesion->getSesion('usuario')[3],
        ];

        $id = [$data['idProyecto']];
        if(!empty($_POST['idProyecto'])){
          $this->model->setProyecto($data);
          $this->formulario($id);
          echo "<script>swal('PSP', 'El proyecto se actualizo correctamente', 'success')</script>";

        }else{
          $data['idProyecto'] = getDate()[0];
          $data['fechaIn'] = getDate()['year']."-".getDate()['mon']."-".getDate()['mday'];
          $this->model->crear($data);
          $this->formulario($id);
          echo "<script>swal('PSP', 'El proyecto se creo correctamente', 'success')</script>";

        }

    }

    function eliminar($codigo){
      $aux = $codigo;
      $codigo = (empty($codigo[0])) ? "nada" : $codigo[0] ;
      if($codigo == "nada" || $codigo == ""){
        $this->redirect('proyectos/lista');
      }

      $this->loadModel('proyectosModel');
      $programadores = $this->model->getProgramadores($codigo);

      if($programadores){
        $this->formulario($aux);
        echo "<script>swal('PSP', 'Este proyecto ya cuenta con programadores asociados. NO es posible ser eliminado', 'error')</script>";
      }else{
          $this->model->eliminar($codigo);
          $this->render();
          echo "<script>swal('PSP', 'se Elimino correctamente', 'success')</script>";
      }
    }
    function formulario($id = -1){
      $id = ($id == -1) ? [0] : $id;

      $this->loadModel('medidasModel');
      $this->view->listMedidas = $this->model->getListado();

      $this->loadModel('procesosModel');
      $this->view->listProcesos = $this->model->getListado();

      $this->loadModel('proyectosModel');
      $this->view->data = $this->model->get($id);


      $this->loadModel('lenguajesModel');
      $this->view->listLenguajes = $this->model->getListado();

      $this->view->render('proyectos/formulario');
    }

    function asociar($codigo){
        $codigo = $codigo[0];
        $this->loadModel('titulosModel');
        $this->view->titulos = $this->model->getListado();
        if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
            $this->formulario($this->view->sesion->getSesion('usuario')[3]);
            die;
        }

        $this->loadModel('gestionProyetoModel');
        $this->view->idProyecto = $codigo;

        $this->view->data = $this->model->getListadoProgramadoresAsociados($codigo);
        $this->loadModel('proyectosModel');
        $this->view->totalAsociados = $this->model->NoAsociados($codigo);

        $this->view->render('programador/listadoAsociar');
    }
    function asociando($data){
      $cedula = $data[0];
      $idProyecto = $data[1];

      $aux2 = [$cedula];
      $aux = [$idProyecto];

      $this->loadModel('gestionProyetoModel');
      $resultValid = $this->model->asociar($cedula, $idProyecto);
      $this->asociar($aux);

      $this->loadModel('usuariosModel');
      $nombreProgramador = $this->model->getUsuario($aux2)[0]['nombre'];
      if($resultValid){
        echo "<script>swal('PSP', 'Se guardó a ".$nombreProgramador." como un nuevo asociado', 'success')</script>";
      }
    }


    function desasociar($data){
      $cedula = $data[0];
      $idProyecto = $data[1];

      $aux2 = [$cedula];
      $aux = [$idProyecto];

      $this->loadModel('gestionProyetoModel');
      $idProyectoUsuario = $this->model->validarAsociado($cedula, $idProyecto)['idProyectoUsuario'];

      $this->loadModel('usuariosModel');
      $nombreProgramador = $this->model->getUsuario($aux2)[0]['nombre'];

      if($idProyectoUsuario){
        $this->model->eliminarHistorial($idProyectoUsuario);

        $this->loadModel('gestionProyetoModel');
        $resultValid = $this->model->desasociar($cedula, $idProyecto);
      }




      $this->asociar($aux);
      if($resultValid){
        echo "<script>swal('PSP', 'Se eliminó a ".$nombreProgramador." como asociado de este proyecto', 'success')</script>";
      }
    }
  }



?>
