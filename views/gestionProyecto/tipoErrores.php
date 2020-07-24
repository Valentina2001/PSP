<?php $title = "Lenguajes | Listado errroes"; include_once "views/head.php"; include_once "views/header.php"?>


<section class="section">
    <div class="content py-3 px-4">
        <div class="content__info">
            <div class="table" >
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                      <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($this->data as $row) {
                          echo "<tr><td id='codigo'>".$row['codigo']."</td>";
                          echo "<td id='nombre'>".$row['nombre']."</td>";
                          echo "<td id='descripcion'>".$row['descripcion']."</td>";
                          echo "<td class='text-center'><a href='#' class='btn btn-outline-primary fas fa-info visualizar-errores' data-toggle='modal' data-target='#detallesErrores'></a> </td></tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="float-right">
              Total: <?php echo count($this->data) ?>
            </div>
        </div>
</section>

<div class="modal fade " id="detallesErrores">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-light">Personal Software Process</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="post" action="<?php echo constant('URL') ?>/gestionProyecto/erroresActualizar">
                  <div class="form-row">
                    <div class="form-group col-12  col-sm-6">
                      Codigo
                      <input type="text" disabled placeholder="Codigo" class="form-control " id="mCodigo">
                    </div>
                    <div class="form-group col-12  col-sm-6">
                      Nombre
                      <input type="text" disabled placeholder="Codigo" class="form-control " id="mNombre">
                    </div>
                  </div>
                  <div class="form-group col-12">
                    Descripcion
                    <textarea rows="4" cols="80" id="mDescripcion" placeholder="Descripcion" class="form-control" disabled></textarea>
                  </div>
                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
