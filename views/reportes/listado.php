<?php $title = "Proyectos | Reportes generales"; include_once "views/head.php"; include_once "views/header.php"?>
<section class="section">
    <div class="content py-3 px-4">
      <?php
      if(empty($this->data)){
        echo "
        <div class='alert alert-warning'>
        <h4 class='alert-heading'>Personal Software Process</h4>
        <p>Al parecer no hay ningún registro creado</p>
        </div>
        ";

        include_once "views/footer.php";
        include_once "views/modalCambioPassword.php";
        die;
      }

      include_once "imprimirProgramador.php";

      ?>

        <div class="content__head">
          <div class="content__search pb-4">
            <div class="input-group">
              <input type="text" class="form-control " id="search" placeholder="Buscar programador">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
            </div>
          </div>
        </div>
        <div class="content__info">
          <?php
            foreach ($this->data as $row) {
              if(!empty($row['proyectos'])){
                echo '
                <div class="container-programador">
                  <div class="row d-flex align-items-center pb-4">
                    <div class="col-12 col-md-6 ">' . $row['nombre'] .' '. $row['apellido'] .'
                  </div>
                  <div class="col-12 col-md-6 text-right">
                    <a href="'.constant('URL').'ReportesGenerales/reporte/'.$row['cedulaUsuario'].'" class="btn btn-outline-info">Ver graficas personalizadas</a>
                    </div>
                  </div>
                  <div class="container reporte-swiper">
                    <div class="row">
                      ';
                      imprimirMensaje($row['proyectos']);
                      echo '
                    </div>
                  </div>
                </div><hr>';


              }
            }
          ?>
</section>

<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
