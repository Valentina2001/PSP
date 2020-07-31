<?php $title = "Lenguajes | Registro PIP"; include_once "views/head.php"; include_once "views/header.php"?>


<section class="section">
    <div class="content py-3  ">
      <div class="container">
        <div class="row">
          <form class="form  col-12 col-lg-4" method="post" action = "<?php echo constant('URL') ?>gestionProyecto/pipRegistro">
            <div class="row m-0">
              <div class="m-0">
                <div class="form-group">
                  Descripción Problema
                  <textarea name="problema" rows="6" cols="80" class="form-control" placeholder="Descripción de problema" required></textarea>
                </div>
                <div class="form-group">
                  Descripción de la propuesta
                  <textarea name="propuesta" rows="6" cols="80" class="form-control" placeholder="Descripción de propuesta" required></textarea>
                </div>
                <div class="form-group">
                  Descripción de la solución
                  <textarea name="comentarios" rows="6" cols="80" class="form-control" placeholder="Descripción de la solución" required></textarea>
                </div>
                <div class="form-group">
                  <button type="reset" id="resetear2" class="btn btn-outline-danger">Cancelar</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
               </div>
            </form>
          </div>
          <div class="col-12 col-lg-8 p-0">
            <div class="" style="max-height: 80vh; overflow: auto;">
              <table class="table table-sm table-bordered table-striped" >
                  <thead class="table-primary">
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Fecha</th>
                      <th scope="col" colspan="2">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($this->data as $row) {
                        echo "<tr><td id='id'>".$row['idPip']."</td>";
                        echo "<td id='fecha'>".$row['fecha']."</td>";
                        echo "<td id='descripcion' class='d-none'>".$row['descripcion']."</td>";
                        echo "<td id='solucion' class='d-none'>".$row['solucion']."</td>";
                        echo "<td id='comentarios' class='d-none'>".$row['comentarios']."</td>";
                        echo "<td class='text-center'><a href='".constant('URL')."gestionProyecto/pipEliminar/".$row['idPip']."' class='btn btn-outline-danger fas fa-info far fa-trash-alt'></a> </td>";
                        echo "<td class='text-center'><a href='#' class='btn btn-outline-primary fas fa-info visualizar-modal' data-toggle='modal' data-target='#detallesTiempo'></a> </td></tr>";
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

<div class="modal fade " id="detallesTiempo">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-light">Personal Software Process</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" action="<?php echo constant('URL') ?>gestionProyecto/pipActualizar">
                  <div class="form-group col-12 col-sm-12 p-0 m-0 mb-2">
                    <input type="hidden" name="id" id="mId">
                    Fecha de registro
                    <input type="text" disabled placeholder="fecha" class="form-control" id="mFecha">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-12 col-md-4">
                      Descripción del problema
                      <textarea name="problema" rows="6" cols="80" class="form-control" placeholder="Descripción del problema" required id="mProblema"></textarea>
                    </div>
                    <div class="form-group col-12 col-md-4">
                      Descripción de la propuesta
                      <textarea name="propuesta" rows="6" cols="80" class="form-control" placeholder="Descripción de la propuesta" required id="mPropuesta"></textarea>
                    </div>
                    <div class="form-group col-12 col-md-4">
                      Comentarios
                      <textarea name="comentario" rows="6" cols="80" class="form-control" placeholder="Comentarios" required id="mComentario"></textarea>
                    </div>
                  </div>
                  <input type="submit" class="d-none" id="ctaGuardar">
                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <label for="ctaGuardar" class="btn btn-success mt-2">Guardar</label>
            </div>
        </div>
    </div>
</div>

<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
