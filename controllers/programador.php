<?php
  class Programador extends Controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();

      if($this->view->sesion->getSesion('usuario') == -1){
        $this->view->redirect('');
      }
    }
    function formAdmin(){
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
        $this->view

        ->redirect('programador');
        die;
      }

      $this->view->render('programador/formAdmin');
    }

    function eliminar($cedula){
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
        $this->view->redirect('programador');
        die;
      }


      $this->loadModel('GestionProyetoModel');
      $result = $this->model->validarListadoAsociado($cedula[0]);
      $this->loadModel('usuariosModel');
      foreach ($result as $row) {
        $this->model->eliminarHistorial($row['idProyectoUsuario']);
      }

      $this->loadModel('usuariosModel');
      $this->model->eliminar($cedula[0]);

      $this->render();



    }

    function nuevo(){
      $data = [
        'cedula' => (empty($_POST['cedula'])) ? null : $_POST['cedula'] ,
        'email' => (empty($_POST['email'])) ? null : $_POST['email'] ,
        'nombre' => (empty($_POST['nombre'])) ? null : $_POST['nombre'] ,
        'apellido' => (empty($_POST['apellido'])) ? null : $_POST['apellido'],
        'user' => (empty($_POST['user'])) ? null : $_POST['user'],
        'password' => (empty($_POST['password'])) ? null : $_POST['password'],
        'password2' => (empty($_POST['password2'])) ? null : $_POST['password2'],
      ];
      $this->view->render('programador/formAdmin');
      if($data['cedula'] == null || $data['email'] == null || $data['user'] == null || $data['password'] == null || $data['password2'] == null){
        echo "<script>swal('PSP', 'Ingresa toda la información', 'warning')</script>";
        die;
      }

      $this->loadModel('usuariosModel');
      $validCedula = $this->model->validar('cedulaUsuario', $data['cedula']);
      $validEmail = $this->model->validar('email', $data['email']);
      $validUser = $this->model->validar('user', $data['user']);

      if($validCedula){
        echo "<script>swal('PSP', 'Ya existe un programador con esta cedula', 'error')</script>";
        return false;
      }
      if($validEmail){
        echo "<script>swal('PSP', 'El correo ingresado ya se encuentra registrado', 'warning')</script>";
        return false;
      }
      if($validUser){
        echo "<script>swal('PSP', 'El usuario ya se encuentra registrado', 'warning')</script>";
        return false;
      }

      if(!$data['password'] === $data['password2']){
        echo "<script>swal('PSP', 'Las contraseñas son incorrectas', 'info')</script>";
        return false;
      }

      $this->model->nuevo($data);
      echo "<script>swal('PSP', 'El programador se a guardado con exito', 'success')</script>";
    }

    function setAspirante($cedula){
      $this->loadModel('usuariosModel');
      $this->model->aspirante($cedula);

      $this->view->redirect('programador/rechazados');
    }

    function delAspirante($cedula){
      $this->loadModel('usuariosModel');
      $this->model->rechazados($cedula);

      $this->view->redirect('programador/aspirantes');
    }

    function cambiarPassword(){
      $data = [
        'actualPassword' => (isset($_POST['actualPassword'])) ? $_POST['actualPassword'] : "",
        'nuevaPassword' => (isset($_POST['nuevaPassword'])) ? $_POST['nuevaPassword'] : "",
        'confirmPassword' => (isset($_POST['confirmPassword'])) ? $_POST['confirmPassword'] : ""

      ];
      $this->view->render('programador/cambioPassword');
      $this->loadModel('usuariosModel');
      $cedula = [$this->view->sesion->getSesion('usuario')[3]];
      $dataUser = $this->model->getUsuario($cedula);

      if(password_verify($data['actualPassword'], $dataUser[0]['password'])){
          if($data['nuevaPassword'] == $data['confirmPassword']){
            $this->model->getPassword($cedula, $data['nuevaPassword']);
            echo '
            <script> swal("PSP", "Se guardo correctamete. Debes volver a inciar sesión", "success")
            .then((value) => {
              location.href="'.constant('URL').'login/cerrarSesion"
            })
            </script>';
          }else{
            echo ' <script> swal("PSP", "Las contraseñas no son iguales", "warning") </script>';
          }
      }else{
        echo ' <script> swal("PSP", "Contraseña incorrecta", "warning") </script>';
      }

    }

    function render(){
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
          $this->formulario($this->view->sesion->getSesion('usuario')[3]);
          die;
      }
      $this->loadModel('titulosModel');
      $this->view->titulos = $this->model->getListado();

      $this->admitidos();

    }

    function aspirantes(){
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
          $this->formulario($this->view->sesion->getSesion('usuario')[3]);
          die;
      }

      $this->loadModel('usuariosModel');
      $this->view->data = $this->model->getListado('0');

      $this->loadModel('titulosModel');
      $this->view->titulos = $this->model->getListado();

      $this->view->render('programador/listadoAspirantes');
    }

    function admitidos(){
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
          $this->formulario($this->view->sesion->getSesion('usuario')[3]);
          die;
      }

      $this->loadModel('usuariosModel');
      $this->view->data = $this->model->getListado('1');

      $this->loadModel('titulosModel');
      $this->view->titulos = $this->model->getListado();

      $this->view->render('programador/listadoAdmitidos');
    }

    function rechazados(){
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
          $this->formulario($this->view->sesion->getSesion('usuario')[3]);
          die;
      }

      $this->loadModel('usuariosModel');
      $this->view->data = $this->model->getListado('3');

      $this->loadModel('titulosModel');
      $this->view->titulos = $this->model->getListado();

      $this->view->render('programador/listadoRechazados');
    }

    function formulario($cedula = 'nada'){
      if($cedula == 'nada'){
        $this->view->redirect('programador');
      }

      if($cedula[0] == $this->view->sesion->getSesion('usuario')[3] && $this->view->sesion->getSesion('usuario')[4] != 'programador'){
        $this->view->redirect('administrador/formulario');

      }
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
        $cedula = [$this->view->sesion->getSesion('usuario')[3]];
      }

      if($cedula != 'nada'){
          $this->loadModel('usuariosModel');
          $resultData = $this->model->getUsuario($cedula);

      }

      $this->view->data = [
        'cedula' => (!isset($resultData[0]['cedula'])) ? "":  $resultData[0]['cedula'],
        'nombre' => (!isset($resultData[0]['nombre'])) ? "":  $resultData[0]['nombre'],
        'apellido' => (!isset($resultData[0]['apellido'])) ? "":  $resultData[0]['apellido'],
        'empresaNombre' => (!isset($resultData[0]['empresa'])) ? "":  $resultData[0]['empresa'],
        'email' => (!isset($resultData[0]['email'])) ? "":  $resultData[0]['email'],
        'password' => (!isset($resultData[0]['password'])) ? "":  $resultData[0]['password'],
        'titulo' => (!isset($resultData[0]['titulo'])) ? "":  $resultData[0]['titulo'],
        'user' => (!isset($resultData[0]['user'])) ? "":  $resultData[0]['user'],
        'fechaIn' => (!isset($resultData[0]['fechaIn'])) ? "":  $resultData[0]['fechaIn'],
        'experienciaEmpresa' => (!isset($resultData[0]['experienciaEmpresa'])) ? "":  $resultData[0]['experienciaEmpresa'],
        'tituloEstudio' => (!isset($resultData[0]['tituloEstudio'])) ? "":  $resultData[0]['tituloEstudio'],
        'enfoqueEstudios' => (!isset($resultData[0]['enfoqueEstudios'])) ? "":  $resultData[0]['enfoqueEstudios'],
        'rol' => (!isset($resultData[0]['rol'])) ? "":  $resultData[0]['rol'],
        'foto' => (!isset($resultData[0]['foto'])) ? "public/img/usuarios/user-default.png":  $resultData[0]['foto'],
        'estado' => (!isset($resultData[0]['estado'])) ? "":  $resultData[0]['estado'],

				'idExpSoftware' => (!isset($resultData[1]['idExpSoftware'])) ? "" : $resultData[1]['idExpSoftware'],
				'cargo' => (!isset($resultData[1]['cargo'])) ? "" : $resultData[1]['cargo'],
				'testing' => (!isset($resultData[1]['testing'])) ? "" : $resultData[1]['testing'],
				'requerimientos' => (!isset($resultData[1]['requerimientos'])) ? "" : $resultData[1]['requerimientos'],
				'experiencia' => (!isset($resultData[1]['experiencia'])) ? "" : $resultData[1]['experiencia'],
				'calidad' => (!isset($resultData[1]['calidad'])) ? "" : $resultData[1]['calidad'],
				'gestionCalidad' => (!isset($resultData[1]['gestionCalidad'])) ? "" : $resultData[1]['gestionCalidad'], #titulo
				'empresa' => (!isset($resultData[1]['empresa'])) ? "" : $resultData[1]['empresa'],
				'gestionConfig' => (!isset($resultData[1]['gestionConfig'])) ? "" : $resultData[1]['gestionConfig'],
				'ut' => (!isset($resultData[1]['ut'])) ? "" : $resultData[1]['ut'],
				'design' => (!isset($resultData[1]['design'])) ? "" : $resultData[1]['design'],
				'cedulaUsuario' => (!isset($resultData[1]['cedulaUsuario'])) ? "" : $resultData[1]['cedulaUsuario'],
				'idHambito' => (!isset($resultData[1]['idHambito'])) ? "" : $resultData[1]['idHambito'],

        'pidExpPorcentual' => (!isset($resultData[2]['idExpPorcentual'])) ? "" : $resultData[2]['idExpPorcentual'],
        'pempresa' => (!isset($resultData[2]['empresa'])) ? "" : $resultData[2]['empresa'],
        'pcalidad' => (!isset($resultData[2]['calidad'])) ? "" : $resultData[2]['calidad'],
        'prequerimientos' => (!isset($resultData[2]['requerimientos'])) ? "" : $resultData[2]['requerimientos'],
        'pcargo' => (!isset($resultData[2]['cargo'])) ? "" : $resultData[2]['cargo'],
        'pgestionConfig' => (!isset($resultData[2]['gestionConfig'])) ? "" : $resultData[2]['gestionConfig'],
        'pgestionCalidad' => (!isset($resultData[2]['gestionCalidad'])) ? "" : $resultData[2]['gestionCalidad'],
        'pcedulaUsuario' => (!isset($resultData[2]['cedulaUsuario'])) ? "" : $resultData[2]['cedulaUsuario'],

        'idExpProgramando' => (!isset($resultData[3]['idExpProgramando'])) ? "" : $resultData[3]['idExpProgramando'],
        'lenguajes' => (!isset($resultData[3]['lenguajes'])) ? "" : $resultData[3]['lenguajes'],
        'lenguajeLDC' => (!isset($resultData[3]['lenguajeLDC'])) ? "" : $resultData[3]['lenguajeLDC'],
        'lenguajesLDC' => (!isset($resultData[3]['lenguajesLDC'])) ? "" : $resultData[3]['lenguajesLDC'],
        'cedulaUsuario' => (!isset($resultData[3]['cedulaUsuario'])) ? "" : $resultData[3]['cedulaUsuario'],
        'idLenguaje' => (!isset($resultData[3]['idLenguaje'])) ? "" : $resultData[3]['idLenguaje']
      ];

      $this->loadModel('lenguajesModel');
      $this->view->listLenguajes = $this->model->getListado();

      $this->view->render('programador/formulario');
    }

    function update(){
      if(!isset($_POST['cedula'])){
        $this->view->redirect('programador/formulario');
        die;
      }
      $this->loadModel('lenguajesModel');
      $data = [
        #usuarios
        'foto' => $this->setImg($_FILES['foto']),
        'cedula' => (!isset($_POST['cedula'])) ? null : $_POST['cedula'] ,
        'nombre' => (!isset($_POST['nombre'])) ? null : $_POST['nombre'] ,
        'apellido' => (!isset($_POST['apellido'])) ? null : $_POST['apellido'] ,
        'email' => (!isset($_POST['email'])) ? null : $_POST['email'] ,
        'empresaNombre' => (!isset($_POST['empresaNombre'])) ? null : $_POST['empresaNombre'] ,
        'experienciaEmpresa' => (!isset($_POST['experienciaEmpresa'])) ? null : $_POST['experienciaEmpresa'] ,
        'enfoque' => (!isset($_POST['enfoque'])) ? null : $_POST['enfoque'] ,
        'tituloProfesional' => (!isset($_POST['tituloProfesional'])) ? null : $_POST['tituloProfesional'] ,
        'tituloDesarrollo' => (!isset($_POST['tituloDesarrollo'])) ? null : $_POST['tituloDesarrollo'] ,

        'idExpSoftware' => (!isset($_POST['idExpSoftware'])) ? "" : $_POST['idExpSoftware'],
				'cargo' => (!isset($_POST['cargo'])) ? "" : $_POST['cargo'],
				'testing' => (!isset($_POST['testing'])) ? "" : $_POST['testing'],
				'requerimientos' => (!isset($_POST['requerimientos'])) ? "" : $_POST['requerimientos'],
				'experiencia' => (!isset($_POST['experiencia'])) ? "" : $_POST['experiencia'],
				'calidad' => (!isset($_POST['calidad'])) ? "" : $_POST['calidad'],
				'gestionCalidad' => (!isset($_POST['gestionCalidad'])) ? "" : $_POST['gestionCalidad'], #titulo
				'empresa' => (!isset($_POST['empresa'])) ? "" : $_POST['empresa'],
				'gestionConfig' => (!isset($_POST['gestionConfig'])) ? "" : $_POST['gestionConfig'],
				'ut' => (!isset($_POST['ut'])) ? "" : $_POST['ut'],
				'design' => (!isset($_POST['design'])) ? "" : $_POST['design'],
				'idHambito' => (!isset($_POST['idHambito'])) ? "" : $_POST['idHambito'],

        'pidExpPorcentual' => (!isset($_POST['pidExpPorcentual'])) ? "" : $_POST['pidExpPorcentual'],
        'pempresa' => (!isset($_POST['pempresa'])) ? "" : $_POST['pempresa'],
        'pcalidad' => (!isset($_POST['pcalidad'])) ? "" : $_POST['pcalidad'],
        'prequerimientos' => (!isset($_POST['prequerimientos'])) ? "" : $_POST['prequerimientos'],
        'pcargo' => (!isset($_POST['pcargo'])) ? "" : $_POST['pcargo'],
        'pgestionConfig' => (!isset($_POST['pgestionConfig'])) ? "" : $_POST['pgestionConfig'],
        'pgestionCalidad' => (!isset($_POST['pgestionCalidad'])) ? "" : $_POST['pgestionCalidad'],

        'idExpProgramando' => (!isset($_POST['idExpProgramando'])) ? "" : $_POST['idExpProgramando'],
        'listLenguajes' => (!isset($_POST['listLenguajes'])) ? "" : $_POST['listLenguajes'],
        'lenguajesLDC' => (!isset($_POST['lenguajesLDC'])) ? "" : $_POST['lenguajesLDC'],
        'lenguaje' => (!isset($_POST['lenguaje'])) ? "" : $this->model->getLenguaje($_POST['lenguaje']),
        'lenguajeLDC' => (!isset($_POST['lenguajeLDC'])) ? "" : $_POST['lenguajeLDC'],
        // 'estado' => (!isset($_POST['estado'])) ? null : $_POST['estado'] ,
      ];
      $cedula = [$data['cedula']];

      $this->loadModel('usuariosModel');
      $validCedula = $this->model->validar('cedulaUsuario', $data['cedula']);
      $validEmail = $this->model->validar('email', $data['email']);

      if($data['email'] == null){
        $this->formulario($cedula);
        echo "<script>swal('PSP', 'El correo electrónico no pueden estar vacios', 'error')</script>";
        die;
      }

      $this->loadModel('usuariosModel');
      $this->model->update($data);
      $this->formulario($cedula);


      if($data['cedula'] == $this->view->sesion->getSesion('usuario')[3]){
        echo '
        <script> swal("PSP", "Se guardo exitosamente", "success")
        .then((value) => {
          swal("PSP", "Para poder ver los cambios debes volver a iniciar sesión", "success"  , {buttons: ["Más tarde", "Iniciar sesión"], })

          .then((willDelete) => {
            if (willDelete) {
              location.href="'.constant('URL').'login/cerrarSesion"
            }
          });
        })
        </script>';
      }else{
        echo "<script>swal('PSP', 'Se guardo exitosamente', 'success')</script>";
      }


    }

    function setImg($fileImg){
      $directorioImg = "public/img/usuarios/";
      $nombreImg = $fileImg['name'];
      if(!empty(basename($fileImg['name']))) {
          $urlImg =  $directorioImg . $nombreImg;
          move_uploaded_file($fileImg['tmp_name'], $urlImg);
          return $urlImg;

      }
      return -1;
    }

    //
    // function listProyectos(){
    //
    //   $this->loadModel('GestionProyetoModel');
    //   $cedula = $this->view->sesion->getSesion('usuario')[3];
    //   $this->view->data = $this->model->getListado($cedula);
    //
    //   $this->loadModel('medidasModel');
    //   $this->view->listMedidas = $this->model->getListado();
    //
    //   $this->loadModel('procesosModel');
    //   $this->view->listProcesos = $this->model->getListado();
    //
    //   $this->view->render('programador/listadoProyectos');
    // }
  }
?>
