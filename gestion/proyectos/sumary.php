<?php $title = "Proyectos | proyectos summary"; include_once "gestion/head.php"; include_once "gestion/header.php"?>

<section class="section">
    <div class="content py-3 px-4">
      <script type="text/javascript">swal('PSP', 'Ya hay un proyecto abierto, por favor cierrelo e intentelo nuevamente', 'warning')</script>

      <?php
      if(empty($this->data)){
        echo "
        <div class='alert alert-warning'>
        <h4 class='alert-heading'>Personal Software Process</h4>
        <p>Al parecer no existes wey</p>
        </div>
        ";

        include_once "gestion/footer.php";
        include_once "gestion/modalCambioPassword.php";
        die;
      }
      ?>

        <div class="content__head">
          <div class="content__search pb-4">
            <div class="input-group">
              <input type="text" class="form-control " id="search" placeholder="Buscar proyectos">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="content__info">



        </div>
</section>
<?php  include_once "gestion/modalCambioPassword.php"; ?>
<?php  include_once "gestion/footer.php";?>
