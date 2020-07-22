<?php
  class Login extends Controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();
      if($this->view->sesion->getSesion('usuario') != -1){
            $this->view->redirect('dashboard');
      }
    }

    function iniciar(){
      $this->view->render('login/index');
    }

    function registrar(){
      $this->view->render('login/registro');
    }


    function iniciando(){
      $data = [
        'usuario' => (empty($_POST['usuario'])) ? null : $_POST['usuario'] ,
        'password' => (empty($_POST['password'])) ? null : $_POST['password'] ,
        'rol' => (empty($_POST['rol'])) ? null : $_POST['rol']
      ];
      if($data['usuario'] == null || $data['password'] == null || $data['rol'] == null){
        $this->view->render('login/index');
        echo "<script>swal('PSP', 'Ingresa toda la información', 'warning')</script>";
        return false;

      }
      $this->loadModel('loginModel');
      $this->view->render('login/index');

      if($data['rol'] == 'administrador'){
        $resultData = $this->model->validarAdmin($data['usuario']);
        if($resultData[0]['usuario'] == $data['usuario'] and password_verify($data['password'], $resultData[0]['password']) ){
          $this->view->sesion->setSesion('usuario', [$resultData[0]['nombre'], $resultData[0]['email'], $resultData[0]['foto'],$resultData[0]['cedula'] , $data['rol'] ]);
          echo "<script>swal('PSP', 'Bienvenido ".$resultData[0]['nombre']."', 'success') .then((value) => {location.href='".constant('URL')."dashboard'})</script>";
        }else{
          echo "<script>swal('PSP', 'Usuario o contraseña incorrecta', 'error')</script>";
        }

      }else if($data['rol'] == 'programador'){
        $resultData = $this->model->validarUsuario($data['usuario']);

        if($resultData[0]['usuario'] == $data['usuario'] and password_verify($data['password'], $resultData[0]['password']) ){
          switch ($resultData[0]['estado']) {
            case 1:
              $this->view->sesion->setSesion('usuario', [$resultData[0]['nombre'], $resultData[0]['email'], $resultData[0]['foto'],$resultData[0]['cedula'] , $data['rol'] ]);
              echo "<script>swal('PSP', 'Bienvenido ".$resultData[0]['nombre']."', 'success') .then((value) => {location.href='".constant('URL')."dashboard'})</script>";
              break;
            case 0:
              echo "<script>swal('PSP', 'Lo sentimos, aun no has sido aprobado intenta nuevamente', 'info') .then((value) => {location.href='".constant('URL')."dashboard'})</script>";
              break;

            case 3:
              echo "<script>swal('PSP', 'Lo sentimos, usted no fue admitido en el programa', 'warning') .then((value) => {location.href='".constant('URL')."dashboard'})</script>";
              break;

            case 2:
              echo "<script>swal('PSP', 'Ya esta certificado en PSP, no tienes más acceso al programa', 'info') .then((value) => {location.href='".constant('URL')."dashboard'})</script>";
              break;

          }
        }else{
          echo "<script>swal('PSP', 'Usuario o contraseña incorrecta', 'error')</script>";
        }
      }
      return false;







      // var_dump($data);
    }

    function registrando(){
      $data = [
        'cedula' => (empty($_POST['cedula'])) ? null : $_POST['cedula'] ,
        'email' => (empty($_POST['email'])) ? null : $_POST['email'] ,
        'nombre' => (empty($_POST['nombre'])) ? null : $_POST['nombre'] ,
        'apellido' => (empty($_POST['apellido'])) ? null : $_POST['apellido'],
        'user' => (empty($_POST['user'])) ? null : $_POST['user'],
        'password' => (empty($_POST['password'])) ? null : $_POST['password'],
        'password2' => (empty($_POST['password2'])) ? null : $_POST['password2'],
      ];

      $this->view->render('login/registro');
      if($data['cedula'] == null || $data['email'] == null || $data['user'] == null || $data['password'] == null || $data['password2'] == null){
        echo "<script>swal('PSP', 'Ingresa toda la información', 'warning')</script>";

        // return false;
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


      // var_dump($this->model->validar('cedulaUsuario', '246455489'));
      $this->model->nuevo($data);
      $this->view->sesion->setSesion('usuario', [$data['nombre'], $data['email'], 'public/img/usuarios/user-default.png' , $data['cedula'] , 'programador' ]);
      echo "<script>swal('PSP', 'Se guardo exitosamente', 'success') .then((value) => {location.href='".constant('URL')."programador/formulario/".$data['cedula']."'})</script>";



    }


    function cerrarSesion(){
      $this->view->sesion->delSesion();
      $this->view->redirect('');
    }
  }

?>
