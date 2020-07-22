<?php $title = "Proyectos | Listado"; include_once "views/head.php"; include_once "views/header.php"?>

<section class="section">
    <div class="content py-3 px-4">
      <?php
      if(empty($this->data)){
        echo "
        <div class='alert alert-warning'>
        <h4 class='alert-heading'>Personal Software Process</h4>
        <p>Al parecer no hay ningún proyecto creado</p>
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
              <input type="text" class="form-control " id="search" placeholder="Buscar">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
            </div>
            <a href="<?php echo constant('URL') ?>proyectos/formulario" title="Crear proyecto" class="ml-4 btn btn-outline-success">Crear</a>
          </div>
        </div>

        <div class="content__info">
            <div class="table" >
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                      <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Proceso</th>
                        <th scope="col">Medida</th>
                        <th scope="col">Fecha creación</th>
                        <th scope="col">Fecha Finalización</th>
                        <th scope="col" colspan="2">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($this->data as $row) {
                          echo "<tr><td>".$row['nombre']."</td>";
                          foreach ($this->listProcesos as $proceso) {
                            if($proceso['idProceso'] == $row['idProceso']){
                              echo "<td>".$proceso['nombre']."</td>";
                            }
                          }
                          foreach ($this->listMedidas as $medidas) {
                            if($medidas['idMedida'] == $row['idMedida']){
                              echo "<td>".$medidas['nombre']."</td>";
                            }
                          }
                          echo "<td>".$row['fechaIn']."</td>";
                          echo "<td>".$row['fechaOut']."</td>";
                          echo "</td><td><a href='".constant('URL')."proyectos/formulario/".$row['idProyecto']."' class='btn btn-outline-secondary fas fa-edit'></a> </td>";
                          echo "</td><td><a href='".constant('URL').'/proyectos/eliminar/'.$row['idProyecto']."' class='btn btn-outline-danger far fa-trash-alt'></a> </td> </tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                  <div class="float-right">
                      Total: <?php echo count($this->data) ?>
                  </div>
                </div>
            </div>
        </div>
</section>
<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
