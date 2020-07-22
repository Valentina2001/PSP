<?php
  Class Administrador extends Controller{
    function __construct(){
      parent::__construct();
      $this->view->sesion->sesionStart();
      if($this->view->sesion->getSesion('usuario') == -1){
        $this->view->redirect('');
      }
      if($this->view->sesion->getSesion('usuario')[4] == 'programador'){
            $this->view->redirect('programador');
      }
    }


    function formulario(){
      $this->loadModel('administradorModel');
      $cedulaAdminsitrador = $this->view->sesion->getSesion('usuario')[3];
       // = $this->view->sesion->getSesion('usuario')[3];
      $resultData = $this->model->getAdministrador($cedulaAdminsitrador);
      $this->view->data = [
        'cedula' => (empty($resultData['cedula'])) ? "":  $resultData['cedula'],
        'nombre' => (empty($resultData['nombre'])) ? "":  $resultData['nombre'],
        'apellido' => (empty($resultData['apellido'])) ? "":  $resultData['apellido'],
        'email' => (empty($resultData['email'])) ? "":  $resultData['email'],
        'user' => (empty($resultData['user'])) ? "":  $resultData['user'],
        'foto' => (empty($resultData['foto'])) ? "":  $resultData['foto'],

      ];

      $this->view->render('administrador/formulario');
      // echo $this->view->sesion->getSesion('usuario')[3];
    }

    function update(){
      $data = [
        'cedula' => (isset($_POST['nombre'])) ?  $_POST['cedula'] : '',
        'foto' => $this->setImg($_FILES['foto']),
        'nombre' => (isset($_POST['nombre'])) ?  $_POST['nombre'] : '',
        'apellido' => (isset($_POST['apellido'])) ?  $_POST['apellido'] : '',
        'email' => (isset($_POST['email'])) ?  $_POST['email'] : '',
        'usuario' => (isset($_POST['usuario'])) ?  $_POST['usuario'] : ''
      ];

      if($data['email'] == null || $data['usuario'] == null){
        $this->formulario();
        echo "<script>swal('PSP', 'El correo electronico o el usuario no pueden estar vacios', 'error')</script>";
        die;
      }

      $this->loadModel('administradorModel');
      $this->model->update($data);
      $this->formulario();

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
    }
    function cambiarPassword(){
      $data = [
        'actualPassword' => (isset($_POST['actualPassword'])) ? $_POST['actualPassword'] : "",
        'nuevaPassword' => (isset($_POST['nuevaPassword'])) ? $_POST['nuevaPassword'] : "",
        'confirmPassword' => (isset($_POST['confirmPassword'])) ? $_POST['confirmPassword'] : ""

      ];
      $this->view->render('administrador/cambioPassword');
      $this->loadModel('administradorModel');
      $cedula = $this->view->sesion->getSesion('usuario')[3];
      $dataAdmin = $this->model->getAdministrador($cedula);


      if(password_verify($data['actualPassword'], $dataAdmin['password'])){
          if($data['nuevaPassword'] == $data['confirmPassword']){
            $this->model->getPassword($cedula, $data['nuevaPassword']);
            echo '
            <script> swal("PSP", "Se guardo correctamete. Debes volver a inciar sesión", "success")
            .then((value) => {
              location.href="'.constant('URL').'login/cerrarSesion"
            })
            </script>';
          }else{
            echo ' <script> swal("PSP", "Las contraseñas no son iguales", "warning")</script>';
          }
      }else{
        echo ' <script> swal("PSP", "Contraseña incorrecta", "warning")</script>';
      }

    }
    function setImg($fileImg){
      $directorioImg = "public/img/administradores/";
      $nombreImg = $fileImg['name'];
      if(basename($fileImg['name'])) {
          $urlImg =  $directorioImg . $nombreImg;
          move_uploaded_file($fileImg['tmp_name'], $urlImg);
          return $urlImg;

      }
      return -1;
    }
  }

?>
