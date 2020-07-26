
<?php $title = "PSP | Iniciar sesión"; include_once "views/head.php" ?>
    <!--Contendor del logo-->
    <section class="login">
      <div class="login__logo p-2">
        <img src="<?php echo constant('URL') ?>public/img/logos/Logo.png" alt="Logo">
      </div>
      <!--Contendor del inicio sesión-->
      <div class="login__formulario">
        <div class="login__formulario--bg py-4 px-3">
          <form method="POST" action="<?php echo constant('URL') ?>login/iniciando" class="col-sm-6">
            <h1 class="login__formulario-title">Inicio sesión</h1>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Usuario" name="usuario">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Contraseña" name="password">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Rol:</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01" name="rol">
                <option value="administrador">Administrador</option>
                <option value="programador">Programador</option>
              </select>
            </div>

            <div class="form-group text-center d-flex justify-content-around">
              <a href="<?php echo constant('URL') ?>login/registrar" class="btn btn-outline-info">Registrate</a>
              <button type="submit" class="btn btn-success">Ingresar</button>
            </div>
          </form>
        </div>
      </div>
    </section>
<?php include_once "views/footer.php" ?>
