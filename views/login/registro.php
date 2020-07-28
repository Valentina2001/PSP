
<?php $title = "PSP | Registrate"; include_once "views/head.php" ?>
    <!--Contendor del logo-->
    <section class="login">
      <div class="login__logo p-2">
        <img src="<?php echo constant('URL') ?>public/img/logos/Logo.png" alt="Logo">
      </div>
      <!--Contendor del inicio sesión-->
      <div class="login__formulario">
        <div class="login__formulario--bg py-4 px-3">
          <form method="POST" action="<?php echo constant('URL') ?>/login/registrando" class="col-sm-6 login__content">
            <h1 class="login__formulario-title">Registrate</h1>
            <div class="form-group">
              <input type="text" class="form-control " placeholder="Cedula:" name="cedula">
            </div>
            <div class="form-group">
              <input type="email" class="form-control " placeholder="Correo electronico:" id="email" name="email">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Nombre completo:" name="nombre">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Apellidos completos:" name="apellido">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Usuario:" id="usuario" name="user">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Contraseña:" id="password" name="password">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Confirmar contraseña:" id="password2" name="password2" disabled>
            </div>
            <span id="text_password2" class="form-text "></span>

            <div class="form-group text-center d-flex justify-content-around align-items-center">
              <a href="<?php echo constant('URL') ?>login/iniciar">¿Ya tienes una cuenta?</a>
              <button type="submit" class="btn btn-success" id="cta" disabled>Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </section>
<?php include_once "views/footer.php" ?>
