<?php
  Class GestionProyecto extends Controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();
      if($this->view->sesion->getSesion('usuario') == -1){
        $this->view->redirect('');
      }
      $this->view->gestionProyecto = $this->view->sesion->getSesion('proyecto');

      if($this->view->sesion->getSesion('usuario')[4] == 'administrador'){
        $this->view->redirect('');
      }

      $this->cedula = $this->view->sesion->getSesion('usuario')[3];
    }

    function render(){
      $this->loadModel('gestionProyetoModel');
      $this->view->data = $this->model->getListado($this->cedula);

      $this->loadModel('medidasModel');
      $this->view->listMedidas = $this->model->getListado();

      $this->loadModel('procesosModel');
      $this->view->listProcesos = $this->model->getListado();

      $this->view->render('gestionProyecto/lista');

    }

    function terminarProyecto($codigo){

      $this->loadModel('gestionProyetoModel');
      $this->model->terminar($this->cedula, $codigo[0]);
      $this->render();
      echo "<script>swal('PSP', 'El proyecto a terminado exitosamente', 'success')</script>";
    }

    function abrirProyecto($codigo = 0){
      $fecha = getdate()['year']. getdate()['mon'].getdate()['mday'];
      $this->loadModel('gestionProyetoModel');

      if($this->view->sesion->getSesion('proyecto') != -1 ) {
        $this->view->redirect('gestionProyecto/summary');
        $resultValid = $this->model->validarAsociado($this->cedula, $codigo[0]);
      }else{

        $this->loadModel('proyectosModel');
        $this->view->sesion->setSesion('proyecto', ['idProyecto' => $codigo[0], 'proceso' => $this->model->get($codigo)['idProceso'],  'terminado' => $resultValid['terminado']]);
        $this->view->redirect('gestionProyecto/summary');
      }

    }

    function cerrarProyecto(){
      $this->view->sesion->unset('proyecto');
      $this->view->redirect('');
    }

    function summary($codigo = 0){
      $codigo = ($codigo == 0) ? " " : $codigo ;

      if($this->view->sesion->getSesion('proyecto') != -1){
        $codigo = [$this->view->sesion->getSesion('proyecto')['idProyecto']];
      }else if($codigo == " "){
        $this->view->redirect('');
      }

      $this->loadModel('ProyectosModel');
      $proyectoData =  $this->model->get($codigo);

      $this->loadModel('lenguajesModel');
      $this->view->listLenguajes = $this->model->getListado();
      $nombreLenguaje = "";

      foreach ($this->view->listLenguajes as $lenguaje ){
        if($lenguaje['idLenguaje'] == $proyectoData['idLenguaje']){
          $nombreLenguaje = $lenguaje['nombre'];
        }
      }

      $this->view->encabezado = [
        'proyecto' => $proyectoData['nombre'],
        'director' => $proyectoData['cedulaAdministrador'],
        'fechaIn' => $proyectoData['fechaIn'],
        'fechaOut' => $proyectoData['fechaOut'],
        'lenguaje' => $nombreLenguaje,
      ];

      $this->loadModel('gestionProyetoModel');
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $this->view->sesion->getSesion('proyecto')['idProyecto'])['idProyectoUsuario'];

      $this->loadModel('planTiempo');
      $this->view->planTiempos = [
        'planeacion' => ( $this->model->get($idProyectoUsuario) ) ? $this->model->get($idProyectoUsuario)['planeacion'] : -1,
        'design' => ( $this->model->get($idProyectoUsuario) ) ? $this->model->get($idProyectoUsuario)['design'] : -1,
        'codigo' => ( $this->model->get($idProyectoUsuario) ) ? $this->model->get($idProyectoUsuario)['codigo'] : -1,
        'compilacion' => ( $this->model->get($idProyectoUsuario) ) ? $this->model->get($idProyectoUsuario)['compilacion'] : -1,
        'pu' => ( $this->model->get($idProyectoUsuario) ) ? $this->model->get($idProyectoUsuario)['pruebasUnitarias'] : -1,
        'pm' => ( $this->model->get($idProyectoUsuario) ) ? $this->model->get($idProyectoUsuario)['postMortem'] : -1,
      ];

      $this->loadModel('tiempoModel');
      $this->view->tablaTiempos = [
        'planeacion' => $this->model->sumatoria($idProyectoUsuario, 'fase01'),
        'desing' => $this->model->sumatoria($idProyectoUsuario, 'fase02'),
        'codigo' => $this->model->sumatoria($idProyectoUsuario, 'fase04'),
        'compilar' => $this->model->sumatoria($idProyectoUsuario, 'fase06'),
        'pu' => $this->model->sumatoria($idProyectoUsuario, 'fase07'),
        'pm' => $this->model->sumatoria($idProyectoUsuario, 'fase08'),
      ];

      $this->view->porcTiempos = [
        'planeacion' => 1,
        'desing' => 5,
        'codigo' => 5,
        'compilar' => 5,
        'pu' => 5,
        'pm' => 5,
      ];
      $this->view->render('gestionProyecto/summary');


    }

    function tiempos(){
      if($this->view->sesion->getSesion('proyecto') == -1){
        $this->view->redirect('');
      }

      $this->loadModel('faseModel');
      $this->view->fases = $this->model->getListado();

      $this->loadModel('gestionProyetoModel');
      $idProyecto =   $this->view->sesion->getSesion('proyecto')['idProyecto'];
      $resultValid = $this->model->validarAsociado($this->cedula, $idProyecto);

      $this->loadModel('tiempoModel');
      $this->view->data = $this->model->getListado($resultValid['idProyectoUsuario']);

      $this->loadModel('planTiempo');
      if($this->model->get($resultValid['idProyectoUsuario']) == false){
        $this->view->render('gestionProyecto/tiempos');
        echo "<script>swal('PSP', 'Para poder comenzar en el proyecto debes llenar la tabla de summary', 'info')</script>";
        die;
      }





      $this->view->render('gestionProyecto/tiempos');
    }



    function tiempoRegistro(){
      $this->loadModel('gestionProyetoModel');
      $resultValid = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $this->view->sesion->getSesion('proyecto')['idProyecto']);
      $data = [
        'idTiempo' => getdate()[0],
        'idProyectoUsuario' => $resultValid['idProyectoUsuario'],
        'tiempoTotal' => (isset($_POST['tiempoTotal'])) ? $_POST['tiempoTotal'] : '',
        'tiempoMuerto' => (isset($_POST['tiempoMuerto'])) ? $_POST['tiempoMuerto'] : '',
        'fase' => (isset($_POST['fase'])) ? $_POST['fase'] : '',
        'fechaIn' => (isset($_POST['fechaIn'])) ? $_POST['fechaIn'] : '',
        'horaIn' => (isset($_POST['horaIn'])) ? $_POST['horaIn'] : '',
        'fechaOut' => (isset($_POST['fechaOut'])) ? $_POST['fechaOut'] : '',
        'horaOut' => (isset($_POST['horaOut'])) ? $_POST['horaOut'] : '',
        'comentarios' => (isset($_POST['comentarios'])) ? $_POST['comentarios'] : '',
        'interrupciones' => (isset($_POST['interrupciones'])) ? $_POST['interrupciones'] : '',
      ];
      $idProyecto =   $this->view->sesion->getSesion('proyecto')['idProyecto'];
      $this->loadModel('gestionProyetoModel');

      if($data['tiempoTotal'] == '' or $data['tiempoMuerto'] == ''){
        $this->view->redirect('gestionProyecto/tiempos');

      }else if($this->model->validarAsociado($this->cedula, $idProyecto)['terminado'] == 1){
        $this->summary();
        echo "<script>swal('PSP', 'El proyecto ya se termino, NO puedes realizar más cambios en el', 'warning')</script>";

      }else{
        $this->loadModel('tiempoModel');
        $this->model->insert($data);
        $this->tiempos();
        echo "<script>swal('PSP', 'El registro de tiempo se guardo satisfactoriamente', 'success')</script>";
      }


    }

    function planTiempo(){
      $this->loadModel('gestionProyetoModel');
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $this->view->sesion->getSesion('proyecto')['idProyecto'])['idProyectoUsuario'];

      $data = [
        'id' => getdate()[0],
        'planeacion' => (isset($_POST['planeacion'])) ? $_POST['planeacion'] : '',
        'design' => (isset($_POST['design'])) ? $_POST['design'] : '',
        'codigo' => (isset($_POST['codigo'])) ? $_POST['codigo'] : '',
        'compilar' => (isset($_POST['compilar'])) ? $_POST['compilar'] : '',
        'ut' => (isset($_POST['ut'])) ? $_POST['ut'] : '',
        'pm' => (isset($_POST['pm'])) ? $_POST['pm'] : '',
        'idpu' => $idProyectoUsuario,
      ];

      if($data['planeacion'] == '' || $data['design'] == '' || $data['codigo'] == '' || $data['compilar'] =='' || $data['ut'] == '' || $data['pm'] == '' ){
        $this->view->redirect('gestionProyecto/summary');
        die;
      }
      // var_dump($data);
      $this->loadModel('planTiempo');
      $this->model->insert($data);

      $this->view->redirect('gestionProyecto/summary');

    }

  }
?>
