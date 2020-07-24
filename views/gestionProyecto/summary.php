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

      <div class="content__info mt-4">
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
            </div>
        </form>
      </div>
</section>
<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>