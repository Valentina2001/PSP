<?php $title = "Lenguajes | Proyectos summary"; include_once "views/head.php"; include_once "views/header.php"?>


<section class="section">
    <div class="content py-3 ">
      <div class="content__head d-flex justify-content-center">
        <div class="row  text-left d-flex justify-content-center">
          <div class="col-12 col-sm-3">
            <label for="proyecto">Proyecto</label>
            <input type="text" name="" value="<?php echo $this->encabezado['proyecto'] ?>" id="proyecto" class="form-control" disabled>
          </div>

          <div class="col-12 col-sm-3">
            <label for="proyecto">Director Proyecto</label>
            <input type="text" name="" value="<?php echo $this->encabezado['director'] ?>" id="proyecto" class="form-control" disabled>
          </div>
          <div class="col-12 col-sm-3">
            <label for="proyecto">Lenguaje</label>
            <input type="text" name="" value="<?php echo $this->encabezado['lenguaje'] ?>" id="proyecto" class="form-control" disabled>
          </div>
        </div>
        <div class="row  text-left">
          <div class="col-12 col-sm-6">
            <label for="proyecto">Fecha Inicio</label>
            <input type="text" name="" value="<?php echo $this->encabezado['fechaIn'] ?>" id="proyecto" class="form-control" disabled>
          </div>
          <div class="col-12 col-sm-6">
            <label for="proyecto">Fecha Maxima</label>
            <input type="text" name="" value="<?php echo $this->encabezado['fechaOut'] ?>" id="proyecto" class="form-control" disabled>
          </div>
        </div>
      </div>

      <div class="mt-4">
        <?php
          if($this->sesion->getSesion('proyecto')['proceso'] != 'psp0' and $this->sesion->getSesion('proyecto')['proceso'] != 'psp01' ){
            echo '
            <h3><b>Resumen de productividad</b></h3>
            <form class="table pb-4" method="post" action="'.constant('URL').'gestionProyecto/insertResumenProyecto">
                <table class="table table-sm table-bordered ">
                    <thead class="table-primary">
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">Plan</th>
                        <th scope="col">Actual</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <tr>
                        <th class="text-left">Productividad (Tamaño/Hora)</th>
                        <td>'.$this->planResumenProductividad.'</td>
                        <td>'.$this->actualResumenProductividad.'</td>
                      </tr>
                    </tbody>
                  </table>
            </form>
            ';
            }

          if($this->sesion->getSesion('proyecto')['proceso'] != 'psp0'){
            echo '
            <h3><b>Resumen tamaño proyecto</b></h3>
            <form class="table pb-4" method="post" action="'.constant('URL').'gestionProyecto/insertResumenProyecto">
                <table class="table table-sm table-bordered ">
                    <thead class="table-primary">
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">Plan</th>
                        <th scope="col">Actual</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <tr>
                        <th class="text-left">Tamaño</th>
                        <td class="d-none"><input type="number" name="idResumenProyecto" value="'.$this->resumenProyecto['idResumenProyecto'] .'" class="form-control"> </td>
                        <td  style="max-width: 150px;"><input type="number" name="planResumenProyecto" value="'.$this->resumenProyecto['plan'] .'" class="form-control" required> </td>
                        <td  style="max-width: 150px;"><input type="number" name="actualResumenProyecto" value="'.$this->resumenProyecto['actual'] .'" class="form-control" required> </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="float-right">
                    <div class="float-right">
                      <div class="form-group">
                        <button type="sumbit" class="btn btn-success">Guardar</button>
                      </div>
                    </div>
                  </div>
            </form>
            ';
            }
          ?>
        <h3><b>Tiempo en fase</b></h3>
        <form class="table" method="post" action="<?php echo constant('URL') ?>gestionProyecto/planTiempo">
            <table class="table table-sm table-bordered ">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">Fase</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Actual</th>
                    <th scope="col">Actual %</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <th class="text-left">Planeación</th>
                    <?php
                      if($this->planTiempos['planeacion'] != -1){
                        echo '<td>'. $this->planTiempos['planeacion'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="planeacion" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaTiempos['planeacion']; ?></td>
                    <td><?php echo $this->porcTiempos['planeacion']; ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Diseño</th>
                    <?php
                      if($this->planTiempos['design'] != -1){
                        echo '<td>'. $this->planTiempos['design'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="design" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaTiempos['desing'] ?></td>
                    <td><?php echo $this->porcTiempos['desing'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Diseño Revisado</th>
                    <?php
                      if($this->planTiempos['designRevisado'] != -1){
                        echo '<td>'. $this->planTiempos['designRevisado'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="designRevisado" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaTiempos['desingRevisado'] ?></td>
                    <td><?php echo $this->porcTiempos['desingRevisado'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Código</th>
                    <?php
                      if($this->planTiempos['codigo'] != -1){
                        echo '<td>'. $this->planTiempos['codigo'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="codigo" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaTiempos['codigo'] ?></td>
                    <td><?php echo $this->porcTiempos['codigo'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Código revisado</th>
                    <?php
                      if($this->planTiempos['codigoRevisado'] != -1){
                        echo '<td>'. $this->planTiempos['codigoRevisado'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="codigoRevisado" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaTiempos['codigoRevisado'] ?></td>
                    <td><?php echo $this->porcTiempos['codigoRevisado'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Compilar</th>
                    <?php
                      if($this->planTiempos['compilacion'] != -1){
                        echo '<td>'. $this->planTiempos['compilacion'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="compilar" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaTiempos['compilar'] ?></td>
                    <td><?php echo $this->porcTiempos['compilar'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Pruebas Unitarias</th>
                    <?php
                      if($this->planTiempos['pu'] != -1){
                        echo '<td>'. $this->planTiempos['pu'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="ut" value="" class="form-control" required> </td>';
                      }
                    ?>

                    <td><?php echo $this->tablaTiempos['pu'] ?></td>
                    <td><?php echo $this->porcTiempos['pu'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Post Mortem</th>
                    <?php
                      if($this->planTiempos['pm'] != -1){
                        echo '<td>'. $this->planTiempos['pm'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="pm" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaTiempos['pm'] ?></td>
                    <td><?php echo $this->porcTiempos['pm'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Total</th>
                    <td>
                      <?php
                        $suma = 0;
                        foreach ($this->planTiempos as $value) {
                          if($value != -1){
                            $suma += $value;
                          }
                        }
                        echo $suma;
                      ?>
                    </td>
                    <td>
                      <?php
                        $suma = 0;
                        foreach ($this->tablaTiempos as $value) {
                          $suma += $value;
                        }
                        echo $suma;
                      ?>
                    </td>
                    <td>
                    </td>
                  </tr>

                </tbody>
              </table>
              <div class="float-right">
                <?php
                  if($this->planTiempos['design'] == -1){
                    echo '
                      <div class="form-group">
                      <button type="sumbit" class="btn btn-success">Guardar</button>
                      </div>
                    ';
                  }
                ?>
              </div>
        </form>
        <br>
        <h3><b>Defectos inyetados en fase</b></h3>
        <form class="table" method="post" action="<?php echo constant('URL') ?>gestionProyecto/planDefectos">
            <table class="table table-sm table-bordered ">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">Fase</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Actual</th>
                    <th scope="col">Actual %</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <th class="text-left">Planeación</th>
                    <?php
                      if($this->planDefectos['planeacion'] != -1){
                        echo '<td>'. $this->planDefectos['planeacion'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="planeacion" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefectos['planeacion']; ?></td>
                    <td><?php echo $this->porcDefectos['planeacion']; ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Diseño</th>
                    <?php
                      if($this->planDefectos['design'] != -1){
                        echo '<td>'. $this->planDefectos['design'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="design" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefectos['desing'] ?></td>
                    <td><?php echo $this->porcDefectos['desing'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Diseño Revisado</th>
                    <?php
                      if($this->planDefectos['designRevisado'] != -1){
                        echo '<td>'. $this->planDefectos['designRevisado'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="designRevisado" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefectos['desingRevisado'] ?></td>
                    <td><?php echo $this->porcDefectos['desingRevisado'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Código</th>
                    <?php
                      if($this->planDefectos['codigo'] != -1){
                        echo '<td>'. $this->planDefectos['codigo'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="codigo" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefectos['codigo'] ?></td>
                    <td><?php echo $this->porcDefectos['codigo'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Código Revisado</th>
                    <?php
                      if($this->planDefectos['codigoRevisado'] != -1){
                        echo '<td>'. $this->planDefectos['codigoRevisado'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="codigoRevisado" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefectos['codigoRevisado'] ?></td>
                    <td><?php echo $this->porcDefectos['codigoRevisado'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Compilar</th>
                    <?php
                      if($this->planDefectos['compilacion'] != -1){
                        echo '<td>'. $this->planDefectos['compilacion'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="compilar" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefectos['compilar'] ?></td>
                    <td><?php echo $this->porcDefectos['compilar'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Pruebas Unitarias</th>
                    <?php
                      if($this->planDefectos['pu'] != -1){
                        echo '<td>'. $this->planDefectos['pu'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="ut" value="" class="form-control" required> </td>';
                      }
                    ?>

                    <td><?php echo $this->tablaDefectos['pu'] ?></td>
                    <td><?php echo $this->porcDefectos['pu'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Post Mortem</th>
                    <?php
                      if($this->planDefectos['pm'] != -1){
                        echo '<td>'. $this->planDefectos['pm'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="pm" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefectos['pm'] ?></td>
                    <td><?php echo $this->porcDefectos['pm'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Total</th>
                    <td>
                      <?php
                        $suma = 0;
                        foreach ($this->planDefectos as $value) {
                          if($value != -1){
                            $suma += $value;
                          }
                        }
                        echo $suma;
                      ?>
                    </td>
                    <td>
                      <?php
                        $suma = 0;
                        foreach ($this->tablaDefectos as $value) {
                          $suma += $value;
                        }
                        echo $suma;
                      ?>
                    </td>
                    <td>
                    </td>
                  </tr>

                </tbody>
              </table>
              <div class="float-right">
                <?php
                  if($this->planDefectos['design'] == -1){
                    echo '
                      <div class="form-group">
                      <button type="sumbit" class="btn btn-success">Guardar</button>
                      </div>
                    ';
                  }
                ?>
              </div>
        </form>
        <br>
        <h3><b>Defectos removidos en fase</b></h3>
        <form class="table" method="post" action="<?php echo constant('URL') ?>gestionProyecto/planDefectosRemovidos">
            <table class="table table-sm table-bordered ">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">Fase</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Actual</th>
                    <th scope="col">Actual %</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <th class="text-left">Planeación</th>
                    <?php
                      if($this->planDefecEliminados['planeacion'] != -1){
                        echo '<td>'. $this->planDefecEliminados['planeacion'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="planeacion" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefecEliminados['planeacion']; ?></td>
                    <td><?php echo $this->porcDefectosEliminados['planeacion']; ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Diseño</th>
                    <?php
                      if($this->planDefecEliminados['design'] != -1){
                        echo '<td>'. $this->planDefecEliminados['design'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="design" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefecEliminados['desing'] ?></td>
                    <td><?php echo $this->porcDefectosEliminados['desing'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Diseño Revisado</th>
                    <?php
                      if($this->planDefecEliminados['designRevisado'] != -1){
                        echo '<td>'. $this->planDefecEliminados['designRevisado'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="designRevisado" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefecEliminados['desingRevisado'] ?></td>
                    <td><?php echo $this->porcDefectosEliminados['desingRevisado'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Código</th>
                    <?php
                      if($this->planDefecEliminados['codigo'] != -1){
                        echo '<td>'. $this->planDefecEliminados['codigo'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="codigo" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefecEliminados['codigo'] ?></td>
                    <td><?php echo $this->porcDefectosEliminados['codigo'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Código revisado</th>
                    <?php
                      if($this->planDefecEliminados['codigoRevisado'] != -1){
                        echo '<td>'. $this->planDefecEliminados['codigoRevisado'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="codigoRevisado" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefecEliminados['codigoRevisado'] ?></td>
                    <td><?php echo $this->porcDefectosEliminados['codigoRevisado'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Compilar</th>
                    <?php
                      if($this->planDefecEliminados['compilacion'] != -1){
                        echo '<td>'. $this->planDefecEliminados['compilacion'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="compilar" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefecEliminados['compilar'] ?></td>
                    <td><?php echo $this->porcDefectosEliminados['compilar'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Pruebas Unitarias</th>
                    <?php
                      if($this->planDefecEliminados['pu'] != -1){
                        echo '<td>'. $this->planDefecEliminados['pu'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="ut" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefecEliminados['pu'] ?></td>
                    <td><?php echo $this->porcDefectosEliminados['pu'] ?> %</td>
                  </tr>

                  <tr>
                    <th class="text-left">Post Mortem</th>
                    <?php
                      if($this->planDefecEliminados['pm'] != -1){
                        echo '<td>'. $this->planDefecEliminados['pm'].'</td>';
                      }else{
                        echo '<td  style="max-width: 150px;"><input type="number" name="pm" value="" class="form-control" required> </td>';
                      }
                    ?>
                    <td><?php echo $this->tablaDefecEliminados['pm'] ?></td>
                    <td><?php echo $this->porcDefectosEliminados['pm'] ?> %</td>
                  </tr>
                  <tr>
                    <th class="text-left">Total</th>
                    <td>
                      <?php
                        $suma = 0;
                        foreach ($this->planDefecEliminados as $value) {
                          if($value != -1){
                            $suma += $value;
                          }
                        }
                        echo $suma;
                      ?>
                    </td>
                    <td>
                      <?php
                        $suma = 0;
                        foreach ($this->tablaDefecEliminados as $value) {
                          $suma += $value;
                        }
                        echo $suma;
                      ?>
                    </td>
                    <td>
                    </td>
                  </tr>

                </tbody>
              </table>
              <div class="float-right">
                <?php
                  if($this->planDefecEliminados['design'] == -1){
                    echo '
                      <div class="form-group">
                      <button type="sumbit" class="btn btn-success">Guardar</button>
                      </div>
                    ';
                  }
                ?>
              </div>
        </form>
      </div>
    </div>
</section>
<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
