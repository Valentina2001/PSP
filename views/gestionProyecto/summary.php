<?php $title = "Lenguajes | Proyectos summary"; include_once "views/head.php"; include_once "views/header.php"?>


<section class="section">
    <div class="content py-3 ">
      <div class="content__head d-flex justify-content-center">
        <div class="row  text-left d-flex justify-content-center">
          <div class="col-12 col-sm-3">
            <label for="proyecto">Proyecto</label>
            <input type="text" name="" value="<?php echo $this->encabezado['proyecto'] ?>" id="proyecto" class="form-control" disabled>
          </div>

          <div class="col-12 col-sm-3">
            <label for="proyecto">Director Proyecto</label>
            <input type="text" name="" value="<?php echo $this->encabezado['director'] ?>" id="proyecto" class="form-control" disabled>
          </div>
          <div class="col-12 col-sm-3">
            <label for="proyecto">Lenguaje</label>
            <input type="text" name="" value="<?php echo $this->encabezado['lenguaje'] ?>" id="proyecto" class="form-control" disabled>
          </div>
        </div>
        <div class="row  text-left">
          <div class="col-12 col-sm-6">
            <label for="proyecto">Fecha Inicio</label>
            <input type="text" name="" value="<?php echo $this->encabezado['fechaIn'] ?>" id="proyecto" class="form-control" disabled>
          </div>
          <div class="col-12 col-sm-6">
            <label for="proyecto">Fecha Maxima</label>
            <input type="text" name="" value="<?php echo $this->encabezado['fechaOut'] ?>" id="proyecto" class="form-control" disabled>
          </div>
        </div>
      </div>

      <div class="content__info">

      </div>
</section>
<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
