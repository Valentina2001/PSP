<?php $title = "Programadores | Nuevo"; include_once "views/head.php"; include_once "views/header.php"?>

<section class="section pt-4">
  <form name="formulario" method="POST"  action="<?php echo constant('URL') ?>/programador/nuevo"  class=" login__content" enctype="multipart/form-data">
    <div class="container px-3 col-md-5">
        <div class="p-0 m-0 titulo-formulario d-flex justify-content-center " >
          <h1>Nuevo programador</h1>
        </div>
        <div class="flex-column pr-0">
          <div class="form-group">
            <input type="text" class="form-control " placeholder="Cedula:" name="cedula">
          </div>
          <div class="form-group">
            <input type="email" class="form-control " placeholder="Correo electronico:" id="email" name="email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Nombre completo" name="nombre">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Apellidos completos" name="apellido">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Usuario" id="usuario" name="user">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirmar contraseña" id="password2" name="password2" disabled>
          </div>
          <span id="text_password2" class="form-text "></span>

          <div class="form-group text-center d-flex justify-content-around align-items-center">
            <a href="<?php echo constant('URL') ?>/programador" class="btn btn-outline-danger">Cancelar</a>
            <button type="submit" class="btn btn-success" id="cta" disabled>Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>


<?php
  include_once "views/footer.php";
  include_once "views/modalCambioPassword.php";
?>
