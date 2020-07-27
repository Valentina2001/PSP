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

      $this->loadModel('resumenProyecto');
      $this->view->resumenProyecto = $this->model->get($idProyectoUsuario);
      // tiempo
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
      $totalMinutos = 0;
      foreach ($this->view->tablaTiempos as $value) {
        $totalMinutos += $value;
      }


      $this->view->porcTiempos = [
        'planeacion' =>  ($totalMinutos == 0) ? 0 : round(($this->view->tablaTiempos['planeacion'] * 100) / $totalMinutos, 2),
        'desing' => ($totalMinutos == 0) ? 0 : round(($this->view->tablaTiempos['desing'] * 100) / $totalMinutos, 2),
        'codigo' => ($totalMinutos == 0) ? 0 : round(($this->view->tablaTiempos['codigo'] * 100) / $totalMinutos, 2),
        'compilar' => ($totalMinutos == 0) ? 0 : round(($this->view->tablaTiempos['compilar'] * 100) / $totalMinutos, 2),
        'pu' => ($totalMinutos == 0) ? 0 : round(($this->view->tablaTiempos['pu'] * 100) / $totalMinutos, 2),
        'pm' => ($totalMinutos == 0) ? 0 : round(($this->view->tablaTiempos['pm'] * 100) / $totalMinutos, 2),
      ];


      // defectos inyectados
      $this->loadModel('PlanDefectos');
      $this->view->planDefectos = [
        'planeacion' => ( $this->model->getInyectados($idProyectoUsuario) ) ? $this->model->getInyectados($idProyectoUsuario)['planeacion'] : -1,
        'design' => ( $this->model->getInyectados($idProyectoUsuario) ) ? $this->model->getInyectados($idProyectoUsuario)['design'] : -1,
        'codigo' => ( $this->model->getInyectados($idProyectoUsuario) ) ? $this->model->getInyectados($idProyectoUsuario)['codigo'] : -1,
        'compilacion' => ( $this->model->getInyectados($idProyectoUsuario) ) ? $this->model->getInyectados($idProyectoUsuario)['compilacion'] : -1,
        'pu' => ( $this->model->getInyectados($idProyectoUsuario) ) ? $this->model->getInyectados($idProyectoUsuario)['pruebasUnitarias'] : -1,
        'pm' => ( $this->model->getInyectados($idProyectoUsuario) ) ? $this->model->getInyectados($idProyectoUsuario)['postMortem'] : -1,
      ];

      $this->loadModel('erroresProyectoModel');
      $this->view->tablaDefectos = [
        'planeacion' => $this->model->sumatoriaDefectos($idProyectoUsuario, 'fase01'),
        'desing' => $this->model->sumatoriaDefectos($idProyectoUsuario, 'fase02'),
        'codigo' => $this->model->sumatoriaDefectos($idProyectoUsuario, 'fase04'),
        'compilar' => $this->model->sumatoriaDefectos($idProyectoUsuario, 'fase06'),
        'pu' => $this->model->sumatoriaDefectos($idProyectoUsuario, 'fase07'),
        'pm' => $this->model->sumatoriaDefectos($idProyectoUsuario, 'fase08'),
      ];
      $totalRemovidos = 0;
      foreach ($this->view->tablaDefectos as $value) {
        $totalRemovidos += $value;
      }

      $this->view->porcDefectos = [
        'planeacion' =>   ($totalRemovidos == 0) ? 0 : round(($this->view->tablaDefectos['planeacion'] * 100) / $totalRemovidos, 2),
        'desing' => ($totalRemovidos == 0) ? 0 :round(($this->view->tablaDefectos['desing'] * 100) / $totalRemovidos, 2),
        'codigo' => ($totalRemovidos == 0) ? 0 :round(($this->view->tablaDefectos['codigo'] * 100) / $totalRemovidos, 2),
        'compilar' => ($totalRemovidos == 0) ? 0 :round(($this->view->tablaDefectos['compilar'] * 100) / $totalRemovidos, 2),
        'pu' => ($totalRemovidos == 0) ? 0 :round(($this->view->tablaDefectos['pu'] * 100) / $totalRemovidos, 2),
        'pm' => ($totalRemovidos == 0) ? 0 :round(($this->view->tablaDefectos['pm'] * 100) / $totalRemovidos, 2),
      ];

      // defectos inyectados
      $this->loadModel('PlanDefectos');
      $this->view->planDefecEliminados = [
        'planeacion' => ( $this->model->getRemovidos($idProyectoUsuario) ) ? $this->model->getRemovidos($idProyectoUsuario)['planeacion'] : -1,
        'design' => ( $this->model->getRemovidos($idProyectoUsuario) ) ? $this->model->getRemovidos($idProyectoUsuario)['design'] : -1,
        'codigo' => ( $this->model->getRemovidos($idProyectoUsuario) ) ? $this->model->getRemovidos($idProyectoUsuario)['codigo'] : -1,
        'compilacion' => ( $this->model->getRemovidos($idProyectoUsuario) ) ? $this->model->getRemovidos($idProyectoUsuario)['compilacion'] : -1,
        'pu' => ( $this->model->getRemovidos($idProyectoUsuario) ) ? $this->model->getRemovidos($idProyectoUsuario)['pruebasUnitarias'] : -1,
        'pm' => ( $this->model->getRemovidos($idProyectoUsuario) ) ? $this->model->getRemovidos($idProyectoUsuario)['postMortem'] : -1,
      ];

      $this->loadModel('erroresProyectoModel');
      $this->view->tablaDefecEliminados = [
        'planeacion' => $this->model->sumatoriaDefectosRemovidos($idProyectoUsuario, 'fase01'),
        'desing' => $this->model->sumatoriaDefectosRemovidos($idProyectoUsuario, 'fase02'),
        'codigo' => $this->model->sumatoriaDefectosRemovidos($idProyectoUsuario, 'fase04'),
        'compilar' => $this->model->sumatoriaDefectosRemovidos($idProyectoUsuario, 'fase06'),
        'pu' => $this->model->sumatoriaDefectosRemovidos($idProyectoUsuario, 'fase07'),
        'pm' => $this->model->sumatoriaDefectosRemovidos($idProyectoUsuario, 'fase08'),
      ];

      $totalErrores = 0;
      foreach ($this->view->tablaDefecEliminados as $value) {
        $totalErrores += $value;
      }

      $this->view->porcDefectosEliminados = [
        'planeacion' =>  ($totalErrores == 0) ? 0 :  round(($this->view->tablaDefecEliminados['planeacion'] * 100) / $totalErrores, 2),
        'desing' => ($totalErrores == 0) ? 0 : round(($this->view->tablaDefecEliminados['desing'] * 100) / $totalErrores, 2),
        'codigo' => ($totalErrores == 0) ? 0 : round(($this->view->tablaDefecEliminados['codigo'] * 100) / $totalErrores, 2),
        'compilar' => ($totalErrores == 0) ? 0 : round(($this->view->tablaDefecEliminados['compilar'] * 100) / $totalErrores, 2),
        'pu' => ($totalErrores == 0) ? 0 : round(($this->view->tablaDefecEliminados['pu'] * 100) / $totalErrores, 2),
        'pm' => ($totalErrores == 0) ? 0 : round(($this->view->tablaDefecEliminados['pm'] * 100) / $totalErrores, 2),
      ];

      $this->view->render('gestionProyecto/summary');

    }
    function insertResumenProyecto(){
      $this->loadModel('gestionProyetoModel');
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $this->view->sesion->getSesion('proyecto')['idProyecto'])['idProyectoUsuario'];


      $data = [
        'id' => (isset($_POST['idResumenProyecto'])) ? $_POST['idResumenProyecto'] : '',
        'plan' => (isset($_POST['planResumenProyecto'])) ? $_POST['planResumenProyecto'] : '',
        'actual' => (isset($_POST['actualResumenProyecto'])) ? $_POST['actualResumenProyecto'] : '',
        'idpu' => $idProyectoUsuario,
      ];
      $this->loadModel('resumenProyecto');

      if( $data['plan'] == '' || $data['actual'] == ''){
        $this->view->redirect('gestionProyecto/summary');
      }else if($data['id'] == ''){
        $this->model->insert($data);
      }else{
        $this->model->actualizar($data);
      }

      $this->view->redirect('gestionProyecto/summary');

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
        $this->tiempos();
        echo "<script>swal('PSP', 'El proyecto ya se termino, NO puedes realizar más cambios en el', 'warning')</script>";
        die;
      }else{
        $this->loadModel('planTiempo');

        if($this->model->get($resultValid['idProyectoUsuario']) == false){
          $this->tiempos();
          echo "<script>swal('PSP', 'Para poder comenzar en el proyecto debes llenar la tabla de summary', 'warning')</script>";
          die;
        }
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

      foreach ($data as $value) {
        if($value == ''){
          $this->view->redirect('gestionProyecto/summary');
          die;
        }
      }
      // var_dump($data);
      $this->loadModel('planTiempo');
      $this->model->insert($data);

      $this->view->redirect('gestionProyecto/summary');
    }

    function planDefectosRemovidos(){
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
      foreach ($data as $value) {
        if($value == ''){
          $this->view->redirect('gestionProyecto/summary');
          die;
        }
      }
      // var_dump($data);
      $this->loadModel('planDefectos');
      $this->model->insertRemovidos($data);
      $this->view->redirect('gestionProyecto/summary');
    }
    function planDefectos(){
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

      foreach ($data as $value) {
        if($value == ''){
          $this->view->redirect('gestionProyecto/summary');
          die;
        }
      }
      // var_dump($data);
      $this->loadModel('planDefectos');
      $this->model->insertInyectados($data);

      $this->view->redirect('gestionProyecto/summary');
    }


    function errores(){
      if($this->view->sesion->getSesion('proyecto') == -1){
        $this->view->redirect('');
      }

      $this->loadModel('gestionProyetoModel');
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $this->view->sesion->getSesion('proyecto')['idProyecto'])['idProyectoUsuario'];

      $this->loadModel('faseModel');
      $this->view->fases = $this->model->getListado();

      $this->loadModel('erroresProyectoModel');
      $this->view->erroresEstandar = $this->model->erroresEstandar();

      $this->view->data = $this->model->getListadoErrores($idProyectoUsuario);

      $this->loadModel('gestionProyetoModel');
      $resultValid = $this->model->validarAsociado($this->cedula, $this->view->sesion->getSesion('proyecto')['idProyecto']);

      $this->view->render('gestionProyecto/errores');
      $this->loadModel('planDefectos');
      if($this->model->getInyectados($resultValid['idProyectoUsuario']) == false){
        echo "<script>swal('PSP', 'Para poder comenzar en el proyecto debes llenar la tabla de summary', 'info')</script>";
      }else if($this->model->getRemovidos($resultValid['idProyectoUsuario']) == false){
        echo "<script>swal('PSP', 'Para poder comenzar en el proyecto debes llenar la tabla de summary', 'info')</script>";
      }

    }


    function erroresRegistro(){
      if($this->view->sesion->getSesion('proyecto') == -1){
        $this->view->redirect('');
      }
      $this->loadModel('gestionProyetoModel');
      $idProyecto =   $this->view->sesion->getSesion('proyecto')['idProyecto'];
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $this->view->sesion->getSesion('proyecto')['idProyecto'])['idProyectoUsuario'];
      $resultValid = $this->model->validarAsociado($this->cedula, $this->view->sesion->getSesion('proyecto')['idProyecto']);

      $this->loadModel('planDefectos');
      if($this->model->getInyectados($resultValid['idProyectoUsuario']) == false){
        $this->errores();
        echo "<script>swal('PSP', 'Para poder comenzar en el proyecto debes llenar la tabla de summary', 'info')</script>";
        die;
      }else if($this->model->getRemovidos($resultValid['idProyectoUsuario']) == false){
        $this->errores();
        echo "<script>swal('PSP', 'Para poder comenzar en el proyecto debes llenar la tabla de summary', 'info')</script>";
        die;
      }



      $data = [
        'id' => getdate()[0],
        'tiempoTotal' => (isset($_POST['tiempoTotal'])) ? $_POST['tiempoTotal'] : '',
        'faseIn' => (isset($_POST['faseIn'])) ? $_POST['faseIn'] : '',
        'faseOut' => (isset($_POST['faseOut'])) ? $_POST['faseOut'] : '',
        'tipoError' => (isset($_POST['tipoError'])) ? $_POST['tipoError'] : '',
        'fechaIn' => (isset($_POST['fechaIn'])) ? $_POST['fechaIn'] : '',
        'horaIn' => (isset($_POST['horaIn'])) ? $_POST['horaIn'] : '',
        'fechaOut' => (isset($_POST['fechaOut'])) ? $_POST['fechaOut'] : '',
        'horaOut' => (isset($_POST['horaOut'])) ? $_POST['horaOut'] : '',
        'comentarioError' => (isset($_POST['comentarioError'])) ? $_POST['comentarioError'] : '',
        'solucionError' => (isset($_POST['solucionError'])) ? $_POST['solucionError'] : '',
        'ldc' => (isset($_POST['ldc'])) ? $_POST['ldc'] : '',
        'idpu' => $idProyectoUsuario,
      ];

      foreach ($data as $value) {
        if($value == ''){
          $this->view->redirect('gestionProyecto/errores');
          die;
        }
      }
      $this->loadModel('gestionProyetoModel');

      if($this->model->validarAsociado($this->cedula, $idProyecto)['terminado'] == 1){
        $this->errores();
        echo "<script>swal('PSP', 'El proyecto ya se termino, NO puedes realizar más cambios en el', 'warning')</script>";

      }else{
        $this->loadModel('ErroresProyectoModel');
        $this->model->insertError($data);
        $this->errores();
        echo "<script>swal('PSP', 'El registro de error se guardo correctamente', 'success')</script>";
      }
    }


    function erroresActualizar(){
      $this->loadModel('gestionProyetoModel');
      $idProyecto =   $this->view->sesion->getSesion('proyecto')['idProyecto'];
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $this->view->sesion->getSesion('proyecto')['idProyecto'])['idProyectoUsuario'];

      $data = [
        'id' => (isset($_POST['id'])) ? $_POST['id'] : '',
        'descripcionError' => (isset($_POST['descripcionError'])) ? $_POST['descripcionError'] : '',
        'descripcionSolucion' => (isset($_POST['descripcionSolucion'])) ? $_POST['descripcionSolucion'] : '',
      ];

      if($this->model->validarAsociado($this->cedula, $idProyecto)['terminado'] == 1){
        $this->errores();
        echo "<script>swal('PSP', 'El proyecto ya se termino, NO puedes realizar más cambios en el', 'warning')</script>";

      }else if($data['descripcionError'] == '' || $data['descripcionSolucion'] == ''){
        $this->errores();
        echo "<script>swal('PSP', 'La descripción no puede quedar vacia', 'warning')</script>";
        die;
      }else{
        $this->loadModel('ErroresProyectoModel');
        $this->model->actualizar($data);

        $this->errores();
        echo "<script>swal('PSP', 'Se actualizo correctametne', 'success')</script>";
      }
    }

    function tipoErrores(){
      $this->loadModel('erroresProyectoModel');
      $this->view->data = $this->model->tipoErrores();

      $this->view->render('gestionProyecto/tipoErrores');
    }

    function pip(){
      if($this->view->sesion->getSesion('proyecto') == -1){
        $this->view->redirect('');
      }else if($this->view->sesion->getSesion('proyecto')['proceso'] == 'psp0'){
        $this->view->redirect('gestionProyecto/summary');
      }

      $this->loadModel('gestionProyetoModel');
      $idProyecto =  $this->view->sesion->getSesion('proyecto')['idProyecto'];
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $idProyecto)['idProyectoUsuario'];

      $this->loadModel('pipModel');
      $this->view->data = $this->model->listado($idProyectoUsuario);

      $this->view->render('gestionProyecto/pip');

    }

    function pipRegistro(){

      $this->loadModel('gestionProyetoModel');
      $idProyecto =  $this->view->sesion->getSesion('proyecto')['idProyecto'];
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $idProyecto)['idProyectoUsuario'];

      $data = [
        'idPip' => getdate()[0],
        'problema' => (isset($_POST['problema'])) ? $_POST['problema'] : '',
        'propuesta' => (isset($_POST['propuesta'])) ? $_POST['propuesta'] : '',
        'comentarios' => (isset($_POST['comentarios'])) ? $_POST['comentarios'] : '',
        'idpu' => $idProyectoUsuario,
      ];

      foreach ($data as $value) {
        if($value == ''){
          $this->view->redirect('gestionProyecto/pip');
        }
      }

      $this->loadModel('pipModel');
      $this->model->insert($data);

      $this->pip();
      echo "<script>swal('PSP', 'El registro del PIP fue exitoso', 'success')</script>";
    }

    function pipActualizar(){
      $data = [
        'idPip' => (isset($_POST['id'])) ? $_POST['id'] : '',
        'problema' => (isset($_POST['problema'])) ? $_POST['problema'] : '',
        'propuesta' => (isset($_POST['propuesta'])) ? $_POST['propuesta'] : '',
        'comentarios' => (isset($_POST['comentario'])) ? $_POST['comentario'] : '',
      ];
      foreach ($data as $value) {
        if($value == ''){
          $this->view->redirect('gestionProyecto/pip');
        }
      }

      $this->loadModel('pipModel');
      $this->model->set($data);

      $this->pip();
      echo "<script>swal('PSP', 'Se actualizo correctamente', 'success')</script>";
    }

    function pipEliminar($id){
      $this->loadModel('pipModel');
      $this->model->eliminar($id[0]);

      $this->pip();
      echo "<script>swal('PSP', 'Se elimino correctamente', 'success')</script>";

    }

    function reportes(){
      if($this->view->sesion->getSesion('proyecto') == -1){
        $this->view->redirect('');
      }else if($this->view->sesion->getSesion('proyecto')['proceso'] == 'psp0' || $this->view->sesion->getSesion('proyecto')['proceso']== 'psp01' ){
        $this->view->redirect('gestionProyecto/summary');
      }

      $this->loadModel('gestionProyetoModel');
      $idProyecto =  $this->view->sesion->getSesion('proyecto')['idProyecto'];
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $idProyecto)['idProyectoUsuario'];


      $this->loadModel('reporteModel');
      $this->view->data = $this->model->listado($idProyectoUsuario);

      $this->view->render('gestionProyecto/reportes');
    }


    function reporteNuevo(){
      $this->loadModel('gestionProyetoModel');
      $idProyecto =  $this->view->sesion->getSesion('proyecto')['idProyecto'];
      $idProyectoUsuario = $this->model->validarAsociado($this->view->sesion->getSesion('usuario')[3], $idProyecto)['idProyectoUsuario'];


      $data = [
        'idpu' => $idProyectoUsuario,
        'id' => getdate()[0],
        'nombre' => (isset($_POST['nombre'])) ? $_POST['nombre'] : '',
        'objetivo' => (isset($_POST['objetivo'])) ? $_POST['objetivo'] : '',
        'condiciones' => (isset($_POST['condiciones'])) ? $_POST['condiciones'] : '',
        'descripcion' => (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '',
        'esperado' => (isset($_POST['esperado'])) ? $_POST['esperado'] : '',
        'actual' => (isset($_POST['actual'])) ? $_POST['actual'] : '',
      ];

      foreach ($data as $value) {
        if($value == ''){
          $this->view->redirect('gestionProyecto/reportes');
          die;
        }
      }

      $this->loadModel('reporteModel');
      $this->model->insert($data);

      $this->reportes();
      echo "<script>swal('PSP', 'El reporte fue guardado cone exito', 'success')</script>";
    }

    function reportesEliminar($id = 'nada'){
      if($id == 'nada'){
        $this->view->redirect('gestionProyecto/reportes');
      }

      $this->loadModel('reporteModel');
      $this->model->eliminar($id[0]);

      $this->reportes();
      echo "<script>swal('PSP', 'El reporte se elimino correctamente', 'success')</script>";
    }


    function reporteActualizar(){
      $data = [
        'id' => (isset($_POST['id'])) ? $_POST['id'] : '',
        'nombre' => (isset($_POST['nombre'])) ? $_POST['nombre'] : '',
        'objetivo' => (isset($_POST['objetivo'])) ? $_POST['objetivo'] : '',
        'condiciones' => (isset($_POST['condiciones'])) ? $_POST['condiciones'] : '',
        'descripcion' => (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '',
        'esperado' => (isset($_POST['esperado'])) ? $_POST['esperado'] : '',
        'actual' => (isset($_POST['actual'])) ? $_POST['actual'] : '',
      ];

      foreach ($data as $value) {
        if($value == ''){
          $this->view->redirect('gestionProyecto/reportes');
          die;
        }
      }

      $this->loadModel('reporteModel');
      $this->model->actualizar($data);

      $this->reportes();
      echo "<script>swal('PSP', 'El reporte se actualizo correctamente', 'success')</script>";

    }
  }
?>
