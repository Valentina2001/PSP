<?php $title = "Lenguajes | Listado lenguajes"; include_once "views/head.php"; include_once "views/header.php"?>

<section class="section">
    <div class="content py-3 px-4">
      <?php
      if(empty($this->data)){
        echo "
        <div class='alert alert-warning'>
        <h4 class='alert-heading'>Personal Software Process</h4>
        <p>Al parecer no hay ningun lenguaje de programación guardado</p>
        </div>
        ";

        include_once "views/footer.php";
        include_once "views/modalCambioPassword.php";
        die;
      }
      ?>
        <div class="content__head">
          <div class="content__search pb-4">
            <div class="input-group">
              <input type="text" class="form-control " id="searchLenguaje" placeholder="Buscar lenguaje">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
            </div>
            <a title="Crear lenguaje" class="ml-4 btn btn-outline-success" data-toggle="modal" data-target="#nuevoLenguaje">Crear</a>
          </div>
        </div>
        <div class="content__info">
            <ul class="lista-lenguajes">
              <?php
                foreach ($this->data as $item) {
                  echo "<li><a data-toggle='modal' data-target='#setLenguaje' class='lenguaje' data-id='".$item['idLenguaje']."'>".$item['nombre']."</a></li>";
                }
               ?>
            </ul>
        </div>
    </div>
</section>

<div class="modal fade" id="setLenguaje">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar lenguaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo constant('URL') ?>lenguajes/setLenguaje">
          <div class="form-group">
            <input type="text" name="idLenguaje" id="MIdLenguaje" class="hide">
            <input type="text" class="form-control" placeholder="Nombre del lenguaje" id="MNombre" name="nombre" required>
          </div>
          <input type="submit" class="hide" id="ctaCambiar">
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button href="#" class="btn btn-success">Guardar</button> -->
        <a href="" data-url="<?php echo constant('URL') ?>lenguajes/eliminar" class="btn btn-outline-danger" id="MLenguaje">Eliminar</a>
        <label for="ctaCambiar" class="btn btn-success mt-2">Guardar Cambios</label>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="nuevoLenguaje">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo lenguaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo constant('URL') ?>lenguajes/nuevo">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Nombre del lenguaje" name="nombre" required>
          </div>
          <input type="submit" class="hide" id="ctaGuardar">
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button href="#" class="btn btn-success">Guardar</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <label for="ctaGuardar" class="btn btn-success mt-2">Guardar Cambios</label>
      </div>
    </div>
  </div>
</div>
<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
