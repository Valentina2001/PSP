<?php $title = "Administrador | Actualizar info"; include_once "views/head.php"; include_once "views/header.php"?>

<section class="section">
  <form name="formulario" method="POST"  action="<?php echo constant('URL') ?>administrador/update"  class="swiper-wrapper" enctype="multipart/form-data">
    <div class="container px-3">
        <div class="p-0 m-0 titulo-formulario d-flex justify-content-center" >
          <h1>Información personal</h1>
        </div>
        <div class="row">
          <div class="col-md-4 formulario_imagen">

            <img src="<?php echo constant('URL').$this->data['foto']; ?>" alt="" id="img_user">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="input_user" aria-describedby="inputGroupFileAddon04" name="foto" >
              <label class="custom-file-label" for="input_user">Seleccionar foto</label>
            </div>
          </div>
          <div class="col-md-7 ab-center flex-column   pr-0">
            <input name="cedula" type="text" class="d-none" value="<?php echo $this->data['cedula'] ?> ">
            <input  type="text" placeholder="Cedula" class="form-control" value="<?php echo $this->data['cedula'] ?> "disabled>
            <div class="input-group">
              <input name="nombre" type="text" placeholder="Nombres Completo" class="form-control mr-2" value="<?php echo $this->data['nombre'] ?>" required>
              <input name="apellido" type="text" placeholder="Apellidos Completo" class="form-control" value="<?php echo $this->data['apellido'] ?>" required>
            </div>
            <input name="email" type="email" placeholder="Correo electronico" class="form-control" value="<?php echo $this->data['email'] ?>" required>
            <div class="input-group">
              <input name="usuario" type="text" placeholder="Usuario" class="form-control" value="<?php echo $this->data['user'] ?>" required>
            </div>
            <div class="">
              <a href="<?php echo constant('URL') ?>programador" class="btn btn-outline-danger">Cancelar</a>
              <button href="#" class="btn btn-success">Guardar</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</form>
</section>
<?php  include_once "views/modalCambioPassword.php"; ?>
<?php include_once "views/footer.php" ?>
