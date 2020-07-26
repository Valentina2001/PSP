<?php $title = "Proyectos | Listado proyectos"; include_once "views/head.php"; include_once "views/header.php"?>
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
              <input type="text" class="form-control " id="search" placeholder="Buscar proyecto">
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
                        <th scope="col" colspan="3">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($this->data as $row) {
                          echo "<tr><td id='nombre' class='cedulas'>".$row['nombre']."</td>";
                          foreach ($this->listProcesos as $proceso) {
                            if($proceso['idProceso'] == $row['idProceso']){
                              echo "<td id='proceso'>".$proceso['nombre']."</td>";
                            }
                          }
                          foreach ($this->listMedidas as $medidas) {
                            if($medidas['idMedida'] == $row['idMedida']){
                              echo "<td id='medida'>".$medidas['acronimo']."</td>";
                            }
                          }
                          echo "<td id='fechaIn'>".$row['fechaIn']."</td>";
                          echo "<td id='fechaOut'>".$row['fechaOut']."</td>";
                          echo "<td id='descripcion' class='d-none'>".$row['descripcion']."</td>";
                          foreach ($this->listLenguajes as $lenguaje ){
                            if($lenguaje['idLenguaje'] == $row['idLenguaje']){
                              echo "<td id='idLenguaje' class='d-none'>".$lenguaje['nombre']."</td>";
                            }
                          }
                          echo "<td><a href='#' data-toggle='modal' class='btn btn-outline-primary visualizar-modal fas fa-info' data-target='#detallesProgramador' ></a>";
                          echo "<td><a href='".constant('URL')."proyectos/formulario/".$row['idProyecto']."' class='btn btn-outline-secondary fas fa-edit'></a> </td>";
                          echo "<td><a href='".constant('URL').'proyectos/eliminar/'.$row['idProyecto']."' class='btn btn-outline-danger far fa-trash-alt'></a> </td> </tr>";
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

<div class="modal fade " id="detallesProgramador">
    <div class="modal-dialog modal-md">
        <div class="modal-content ">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-light" id="exampleModalLabel">Personal Software Process</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row container">
                        <div class="input-group mb-2">
                          <input type="email" disabled placeholder="Nombre proyecto" class="form-control mr-2" id="mNombre">
                          <input type="text" disabled placeholder="Lenguaje" class="form-control ml-2" id="mIdLenguaje">
                        </div>
                        <div class="input-group mb-2">
                            <input type="text" disabled id="mProceso" placeholder="Proceso" class="form-control mr-2" >
                            <input type="text" disabled id="mMedida" placeholder="Medidas" class="form-control ml-2" >
                        </div>
                        <div class="input-group my-2">
                            <input type="date" disabled placeholder="Fecha Ingreso" class="form-control mr-2" id="mFechaIn">
                            <input type="date" disabled placeholder="fecha Finalización" class="form-control ml-2" id="mFechaOut">
                        </div>
                        <textarea rows="8" cols="80" id="mDescripcion" placeholder="Descripcion" class="form-control" disabled></textarea>
                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
