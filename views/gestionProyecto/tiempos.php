<?php $title = "Lenguajes | Proyectos summary"; include_once "views/head.php"; include_once "views/header.php"?>


<section class="section">
    <div class="content py-3  ">
      <div class="container">
        <div class="row">
          <form class="form  col-12 col-lg-4" method="post" action = "<?php echo constant('URL') ?>gestionProyecto/tiempoRegistro">
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
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="fase">Fase:</label>
                  </div>
                  <select class="custom-select" id="fase" name="fase">
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
                <div class="form-row d-none">
                  <div class="form-group col-12 col-sm-6">
                    <label for="fechaIn">Fecha Inicio</label>
                    <input type="date" name="fechaIn" class="form-control" id="fechaIn">
                  </div>
                  <div class="form-group col-12 col-sm-6">
                    <label for="horaIn">Hora Inicio</label>
                    <input type="time" name="horaIn" class="form-control" id="horaIn">
                  </div>
                </div>
                <div class="form-row d-none">
                  <div class="form-group col-12 col-sm-6">
                    <label for="fechaOut">Fecha Fin</label>
                    <input type="date" name="fechaOut" class="form-control" id="fechaOut">
                  </div>
                  <div class="form-group col-12 col-sm-6">
                    <label for="horaOut">Hora Fin</label>
                    <input type="time" name="horaOut" class="form-control" id="horaOut">
                  </div>
                </div>

                <div class="form-group">
                  <textarea name="comentarios" rows="8" cols="80" class="form-control" placeholder="Comentarios sobre el registro de tiempo"></textarea>
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
                      <th scope="col">Fase</th>
                      <th scope="col">Momento In.</th>
                      <th scope="col">Momento Fin</th>
                      <th scope="col">T. Total</th>
                      <th scope="col">T. Muerto</th>
                      <th scope="col" colspan="2">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($this->data as $row) {
                        $option = $this->fases;
                        foreach ($option as $fase) {
                          if($fase['idFase'] == $row['idFase']){
                            echo "<tr><td id='fase' class='cedulas'>".$fase['nombre']."</td>";
                          }
                        }
                        echo "<td id='momentoIn'>".$row['fechaIn']." ".$row['horaIn']."</td>";
                        echo "<td id='momentoOut'>".$row['fechaOut']." ".$row['horaOut']."</td>";
                        echo "<td id='interrupciones' class='d-none'>".$row['interrupciones']."</td>";
                        echo "<td id='tiempo'>".$row['tiempoTotal']."</td>";
                        echo "<td id='tMuerto'>".$row['tiempoMuerto']."</td>";

                        echo "<td id='comentarios' class='d-none'>".$row['comentarios']."</td>";
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
    <div class="modal-dialog modal-md">
        <div class="modal-content ">
            <div class="modal-header bg-primary ">
                <h5 class="modal-title text-light">Personal Software Process</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form ">
                        <div class="form-group col-12 col-sm-12 p-0 m-0 mb-2">
                          Fase
                          <input type="text" disabled placeholder="Fase" class="form-control" id="mFase">
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12  col-sm-6">
                            Tiempo Trabajado
                            <input type="text" disabled placeholder="Tiempo trabajado" class="form-control " id="mTiempo">
                          </div>
                          <div class="form-group col-12  col-sm-6">
                            Tiempo total
                            <input type="text" disabled placeholder="Tiempo Total" class="form-control " id="mTiempoTotal">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12  col-sm-6">
                            Momento inicial
                            <input type="text" disabled placeholder="Momento inicial" class="form-control" id="mMomentoIn">
                          </div>
                          <div class="form-group col-12  col-sm-6">
                            Momento final
                            <input type="text" disabled id="mMomentoOut" placeholder="Momento final" class="form-control " >
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12  col-sm-6">
                            Interrupciones
                            <input type="text" disabled id="mInterrupciones" placeholder="Interrupciones" class="form-control" >
                          </div>
                          <div class="form-group col-12  col-sm-6">
                            Tiempo muerto
                            <input type="text" disabled placeholder="Tiempo muerto" class="form-control " id="MTMuerto">
                          </div>
                        </div>
                        <div class="form-group">
                          <textarea rows="4" cols="80" id="mComentarios" placeholder="Descripcion" class="form-control" disabled></textarea>
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
