<?php $title = "Administrador | Actualizar contraseña"; include_once "views/head.php"; include_once "views/header.php"?>

<section class="section pt-4">
  <form name="formulario" method="POST"  action="<?php echo constant('URL') ?>administrador/cambiarPassword"  class=" login__content" enctype="multipart/form-data">
    <div class="container px-3 col-md-7">
        <div class="p-0 m-0 titulo-formulario d-flex justify-content-center " >
          <h1>Actualizar</h1>
        </div>
        <div class="flex-column pr-0">
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Contraseña actual" name="actualPassword">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirmar contraseña" id="password2" name="password2" disabled>
          </div>
          <span id="text_password2" class="form-text "></span>

          <div class="">
            <a href="<?php echo constant('URL') ?>programador" class="btn btn-outline-danger">Cancelar</a>
            <button href="#" class="btn btn-success">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>

<?php include_once "views/footer.php" ?>
