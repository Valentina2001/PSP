<?php $title = "Lenguajes | Registro defectos"; include_once "views/head.php"; include_once "views/header.php"?>


<section class="section">
    <div class="content py-3  ">
      <div class="container">
        <div class="row">
          <form class="form  col-12 col-lg-4" method="post" action = "<?php echo constant('URL') ?>gestionProyecto/erroresRegistro">
            <div class="row d-flex  justify-content-center">
              <div class="form-row pr-2 d-none" id="contentTiempoInput">
                <div class="form-group col-12 col-sm-6">
                  <label for="fechaOut">Tiempo total</label>
                  <input type="text" class="form-control" id="tiempoTotalInput" disabled>
                </div>
                <div class="form-group col-12 col-sm-6">
                  <label for="horaOut">Tiempo muerto</label>
                  <input type="text" class="form-control" id="tiempoMuertoInput" disabled>
                </div>
              </div>

              <div class="d-flex flex-column align-items-center" id="contentTiempoHtml">
                <div class="form-group text-center">
                  <h1 id="temporizador">0.00</h1>
                </div>
                <div class="form-group">
                  <button type="button" name="button" id='resetear' class="btn btn-outline-danger">Reset</button>
                  <button type="button" name="button" id='guardar' class="btn btn-outline-success">guardar</button>
                  <button type="button" name="button" id="iniciar" class="btn btn-primary">Iniciar</button>
                </div>
              </div>
            </div>
            <br>
            <div class="row m-0">
              <input type="text" name="tiempoTotal" class="d-none form-control" id="tiempoTotal" >
              <input type="text" name="tiempoMuerto" class="d-none form-control" id="tiempoMuerto" >
              <input type="text" name="interrupciones" class="d-none form-control" id="interruptor" >

              <div class="m-0">
                <div class="form-row">
                  <div class="form-group col-12 col-sm-6">
                    <div class="input-group mb-3">
                      <select class="custom-select"  name="faseIn" required>
                        <option value="">Fase inyectado</option>
                        <?php
                        $option = $this->fases;
                        foreach ($option as $fase) {
                          if($fase['idFase'] == $this->data['idFase']){
                            echo '<option value="'.$fase['idFase'].'" selected>'.$fase['nombre'].'</option>';
                          }else{
                            echo '<option value="'.$fase['idFase'].'">'.$fase['nombre'].'</option>';
                          }
                        }
                        ?>

                      </select>
                    </div>
                  </div>
                  <div class="form-group col-12 col-sm-6">
                    <div class="input-group mb-3">
                      <select class="custom-select"  name="faseOut" required>
                        <option value="">Fase eliminación</option>
                        <?php
                        $option = $this->fases;
                        foreach ($option as $fase) {
                          if($fase['idFase'] == $this->data['idFase']){
                            echo '<option value="'.$fase['idFase'].'" selected>'.$fase['nombre'].'</option>';
                          }else{
                            echo '<option value="'.$fase['idFase'].'">'.$fase['nombre'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-12 col-sm-6">
                    <div class="input-group mb-3">
                      <select class="custom-select"  name="tipoError" required>
                        <option value="">Tipo de error</option>
                        <?php
                        $option = $this->erroresEstandar;
                        foreach ($option as $error) {
                          if($error['id'] == $this->data['idErrorTipo']){
                            echo '<option value="'.$error['id'].'" selected>'.$error['nombre'].'</option>';
                          }else{
                            echo '<option value="'.$error['id'].'">'.$error['nombre'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-12 col-sm-6">
                    <input type="number" name="ldc" class="form-control" placeholder="Numero de LDC" min="0" required>
                  </div>
                </div>
                <div class="form-row d-none">
                  <div class="form-group col-12 col-sm-6">
                    <label for="fechaIn">Fecha Inicio</label>
                    <input type="date" name="fechaIn" class="form-control" id="fechaIn" required>
                  </div>
                  <div class="form-group col-12 col-sm-6">
                    <label for="horaIn">Hora Inicio</label>
                    <input type="time" name="horaIn" class="form-control" id="horaIn" required>
                  </div>
                </div>
                <div class="form-row d-none">
                  <div class="form-group col-12 col-sm-6">
                    <label for="fechaOut">Fecha Fin</label>
                    <input type="date" name="fechaOut" class="form-control" id="fechaOut" required>
                  </div>
                  <div class="form-group col-12 col-sm-6">
                    <label for="horaOut">Hora Fin</label>
                    <input type="time" name="horaOut" class="form-control" id="horaOut" required>
                  </div>
                </div>

                <div class="form-group">
                  Descripcion del error
                  <textarea name="comentarioError" rows="4" cols="80" class="form-control" placeholder="Describa el error" required></textarea>
                </div>
                <div class="form-group">
                  Descripcion de la solucion
                  <textarea name="solucionError" rows="4" cols="80" class="form-control" placeholder="Describa como soluciono el error" required></textarea>
                </div>
                <div class="form-group">
                  <button type="reset" id="resetear2" class="btn btn-outline-danger">cancelar</button>
                  <button type="submit" class="btn btn-success" id="ctaGuardar" disabled>guardar</button>
                </div>
               </div>
            </form>
          </div>
          <div class="col-12 col-lg-8 p-0">
            <div class="" style="max-height: 80vh; overflow: auto;">
              <table class="table table-sm table-bordered table-striped" >
                  <thead class="table-primary">
                    <tr>
                      <th scope="col">Fecha registro</th>
                      <th scope="col">Fase iny.</th>
                      <th scope="col">Fase rem.</th>
                      <th scope="col">Tipo error</th>
                      <th scope="col">Reparación LDC</th>
                      <th scope="col" colspan="2">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($this->data as $row) {
                        $option = $this->fases;
                        echo "<tr><td id='momentoIn'>".$row['fechaIn']." ".$row['horaIn']."</td>";
                        echo "<td id='id' class='d-none'>".$row['id']."</td>";
                        echo "<td id='momentoOut' class='d-none'>".$row['fechaOut']." ".$row['horaOut']."</td>";
                        foreach ($option as $fase) {
                          if($fase['idFase'] == $row['faseIn']){
                            echo "<td id='faseIn'>".$fase['nombre']."</td>";
                          }
                        }
                        foreach ($option as $fase) {
                          if($fase['idFase'] == $row['faseOut']){
                            echo "<td id='faseOut'>".$fase['nombre']."</td>";
                          }
                        }
                        echo "<td id='tiempo' class='d-none'>".$row['tiempoSolucionar']."</td>";
                        echo "<td id='faseIn' class='d-none'>".$row['faseIn']."</td>";
                        echo "<td id='faseOut' class='d-none'>".$row['faseOut']."</td>";
                        echo "<td id='descError' class='d-none'>".$row['descripcionError']."</td>";
                        echo "<td id='descSoluc' class='d-none'>".$row['descripcionSolucion']."</td>";
                        $option = $this->erroresEstandar;
                        foreach ($option as $error) {
                          if($error['id'] == $row['idErrorTipo']){
                            echo "<td id='errorTipo'>".$error['nombre']."</td>";
                          }
                        }
                        echo "<td id='ldc'>".$row['reparacionLDC']."</td>";
                        echo "<td class='text-center'><a href='#' class='btn btn-outline-primary fas fa-info visualizar-modal' data-toggle='modal' data-target='#detallesErrores'></a> </td></tr>";
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
                  <input type="text" name="id" value="" id="mid" class="d-none">
                  <div class="form-row">
                    <div class="form-group col-12  col-sm-6">
                      Fecha creación
                      <input type="text" disabled placeholder="Feca inyectado" class="form-control " id="mFechaIn">
                    </div>
                    <div class="form-group col-12  col-sm-6">
                      Fecha eliminación
                      <input type="text" disabled placeholder="Fecha eliminación" class="form-control " id="mFechaOut">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-12  col-sm-4">
                      Tipo Error
                      <input type="text" disabled placeholder="Tipo error" class="form-control" id="mTipoError">
                    </div>
                    <div class="form-group col-12  col-sm-4">
                      No. LDC
                      <input type="number" disabled id="mLDC" placeholder="No. LDC" class="form-control " >
                    </div>
                    <div class="form-group col-12  col-sm-4">
                      Tiempo
                      <input type="text" disabled id="mTiempo" placeholder="Duración" class="form-control " >
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-12  col-sm-6">
                      Fase inyectado
                      <input type="text" disabled id="mFaseIn" placeholder="Fase inyectado" class="form-control" >
                    </div>
                    <div class="form-group col-12  col-sm-6">
                      Fase eliminado
                      <input type="text" disabled placeholder="Fase eliminado" class="form-control " id="mFaseOut">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-12  col-sm-6">
                      Descripcion error
                      <textarea rows="4" cols="80" id="mDescError" placeholder="Descripcion del error" class="form-control" name="descripcionError"></textarea>
                    </div>
                    <div class="form-group col-12  col-sm-6">
                      Descripcion Solución
                      <textarea rows="4" cols="80" id="mDescSoluc" placeholder="Descripcion de la solucion" class="form-control" name="descripcionSolucion"></textarea>
                    </div>
                  </div>
                  <input type="submit" class="d-none" id="cta-actualizar">

                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <label for="cta-actualizar" class="btn btn-success mt-2">Actualizar</label>
            </div>
        </div>
    </div>
</div>

<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
