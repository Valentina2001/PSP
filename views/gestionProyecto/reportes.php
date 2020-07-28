<?php $title = "Lenguajes | Registro reportes"; include_once "views/head.php"; include_once "views/header.php"?>


<section class="section">
    <div class="content py-3  ">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-4">
            <a href="#" data-toggle='modal' class="btn btn-outline-success float-right visualizar-modal" data-target='#reporteNuevo'>Crear reporte</a>
          </div>
          <div class="col-12">
            <div class="" style="max-height: 80vh; overflow: auto;">
              <table class="table table-sm table-bordered table-striped" >
                  <thead class="table-primary">
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Nombre</th>
                      <th scope="col" colspan="2">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($this->data as $row) {
                        echo "<tr><td id='id'>".$row['idReporte']."</td>";
                        echo "<td id='fecha'>".$row['fecha']."</td>";
                        echo "<td id='nombre' class=''>".$row['nombre']."</td>";
                        echo "<td id='objetivo' class='d-none'>".$row['objetivo']."</td>";
                        echo "<td id='condiciones' class='d-none'>".$row['condiciones']."</td>";
                        echo "<td id='resEsperado' class='d-none'>".$row['resEsperado']."</td>";
                        echo "<td id='resActual' class='d-none'>".$row['resActual']."</td>";
                        echo "<td id='descripcion' class='d-none'>".$row['descripcion']."</td>";
                        echo "<td class='text-center'><a href='#' class='btn btn-outline-primary fas fa-info visualizar-modal' data-toggle='modal' data-target='#reporteActualizar'></a> </td>";
                        echo "<td class='text-center'><a href='".constant('URL')."gestionProyecto/reportesEliminar/".$row['idReporte']."' class='btn btn-outline-danger fas fa-info far fa-trash-alt'></a> </td></tr>";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="float-right">
                Total: <?php echo count($this->data) ?>
              </div>
            </div>
        </div>
      </div>
    </div>
</section>

<div class="modal fade" id="reporteActualizar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-light">Personal Software Process</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" action="<?php echo constant('URL') ?>gestionProyecto/reporteActualizar">
                  <input type="hidden" placeholder="Nombre del reporte" class="form-control" name="id" id="mId">
                  <div class="form-row">
                    <div class="form-group col-12 col-sm-6">
                      Fecha registro
                      <input type="text" placeholder="fecha registro" class="form-control"  id="mFecha" disabled>
                    </div>
                    <div class="form-group col-12 col-sm-6">
                      Nombre del reporte
                      <input type="text" placeholder="Nombre del reporte" class="form-control" name="nombre" id="mNombre">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-12 col-md-4">
                      Descripción del objetivo
                      <textarea name="objetivo" rows="6" cols="80" class="form-control" placeholder="Descripción del objetivo" required id="mObjetivo"></textarea>
                    </div>
                    <div class="form-group col-12 col-md-4">
                      Descripción de condiciones
                      <textarea name="condiciones" rows="6" cols="80" class="form-control" placeholder="Descripción de condiciones" required id="mCondiciones"></textarea>
                    </div>
                    <div class="form-group col-12 col-md-4">
                      Descripción
                      <textarea name="descripcion" rows="6" cols="80" class="form-control" placeholder="Descripción" required id="mDescripcion"></textarea>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-12 col-md-6">
                      Respuesta esperada
                      <textarea name="esperado" rows="6" cols="80" class="form-control" placeholder="Respuesta esperada" required id="mEsperada"></textarea>
                    </div>
                    <div class="form-group col-12 col-md-6">
                      Respuesta actual
                      <textarea name="actual" rows="6" cols="80" class="form-control" placeholder="Respuesta actual" required id="mActual"></textarea>
                    </div>
                  </div>
                  <input type="submit" class="d-none" id="ctaActualizarReporte">
                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <label for="ctaActualizarReporte" class="btn btn-success mt-2">Actualizar</label>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade " id="reporteNuevo">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-light">Personal Software Process</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" action="<?php echo constant('URL') ?>gestionProyecto/reporteNuevo">
                  <div class="form-group col-12 col-sm-12 p-0 m-0 mb-2">
                    Nombre del reporte
                    <input type="text" placeholder="Nombre del reporte" class="form-control" name="nombre">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-12 col-md-4">
                      Descripción del objetivo
                      <textarea name="objetivo" rows="6" cols="80" class="form-control" placeholder="Descripción del objetivo" required></textarea>
                    </div>
                    <div class="form-group col-12 col-md-4">
                      Descripción de condiciones
                      <textarea name="condiciones" rows="6" cols="80" class="form-control" placeholder="Descripción de condiciones" required></textarea>
                    </div>
                    <div class="form-group col-12 col-md-4">
                      Descripción
                      <textarea name="descripcion" rows="6" cols="80" class="form-control" placeholder="Descripción" required></textarea>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-12 col-md-6">
                      Respuesta esperada
                      <textarea name="esperado" rows="6" cols="80" class="form-control" placeholder="Respuesta esperada" required></textarea>
                    </div>
                    <div class="form-group col-12 col-md-6">
                      Respuesta actual
                      <textarea name="actual" rows="6" cols="80" class="form-control" placeholder="Respuesta actual" required></textarea>
                    </div>
                  </div>
                  <input type="submit" class="d-none" id="ctaGuardarReporte">
                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <label for="ctaGuardarReporte" class="btn btn-success mt-2">Guardar</label>
            </div>
        </div>
    </div>
</div>
</div>


<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
