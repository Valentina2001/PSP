<?php $title = "Proyectos | proyectos asociados"; include_once "gestion/head.php"; include_once "gestion/header.php"?>

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
            <div class="table" >
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                      <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Proceso</th>
                        <th scope="col">Medida</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha creación</th>
                        <th scope="col">Fecha max</th>
                        <th scope="col" colspan="2">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($this->data as $row) {
                          echo "<tr><td class='cedulas'>".$row['nombre']."</td>";
                          foreach ($this->listProcesos as $proceso) {
                            if($proceso['idProceso'] == $row['idProceso']){
                              echo "<td>".$proceso['acronimo']."</td>";
                            }
                          }
                          foreach ($this->listMedidas as $medidas) {
                            if($medidas['idMedida'] == $row['idMedida']){
                              echo "<td>".$medidas['acronimo']."</td>";
                            }
                          }
                          if($row['terminado']){
                            echo "<td>Terminado</td>";
                          }else{
                            echo "<td>No terminado</td>";
                          }
                          echo "<td>".$row['fechaIn']."</td>";
                          echo "<td>".$row['fechaOut']."</td>";
                          echo "</td><td><a href='".constant('URL')."gestionProyecto/terminarProyecto/".$row['idProyecto']."' class='btn btn-outline-danger far fa-stop-circle' title='Terminar proyecto'></a> </td>";
                          echo "</td><td><a href='".constant('URL').'gestionProyecto/abrirProyecto/'.$row['idProyecto']."' class='btn btn-outline-primary fas fa-share-square' title='Abrir proyecto'></a> </td> </tr>";
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
<?php  include_once "gestion/modalCambioPassword.php"; ?>
<?php  include_once "gestion/footer.php";?>
