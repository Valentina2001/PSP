<?php $title = "Proyectos | Reportes especificos"; include_once "views/head.php"; include_once "views/header.php"?>
<section class="section">
    <div class="content py-3">
      <div class="content__head ">
        <div class="row  text-left">
          <div class="col-12 col-sm-4">
            <label for="proyecto">Cedula</label>
            <input type="text" name="" value="<?php echo $this->data['cedulaUsuario'] ?>" id="proyecto" class="form-control" disabled>
          </div>

          <div class="col-12 col-sm-8">
            <label for="proyecto">Nombres</label>
            <input type="text" name="" value="<?php echo $this->data['nombre']. " ".$this->data['apellido'] ?>" id="proyecto" class="form-control" disabled>
          </div>
        </div>
        <div class="row  text-left">
          <div class="col-10">
            <label for="proyecto">Fecha Ingreso</label>
            <input type="text" name="" value="<?php echo $this->data['fechaIn'] ?>" id="proyecto" class="form-control" disabled>
          </div>
          <div class="col-2 d-flex justify-content-center align-items-end pb-1">
            <?php
              if($this->sesion->getSesion('usuario')[4] == 'administrador'){
                echo '<a href="#" class="btn btn-outline-primary fas fa-search buscar-reporte"></a>';
              }
             ?>
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-12 col-lg-6 graficaChart" p-4 >
            <div  style="width: 100%; height: 40vh" id="piechart">
              <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Task', ''],
                      ['PSP 0.0', <?php echo $this->data['proyecto']['sumaTiempoProceso']['psp0'] ?>],
                      ['PSP 0.1', <?php echo $this->data['proyecto']['sumaTiempoProceso']['psp01'] ?>],
                      ['PSP 1.0', <?php echo $this->data['proyecto']['sumaTiempoProceso']['psp1'] ?>],
                      ['PSP 1.1', <?php echo $this->data['proyecto']['sumaTiempoProceso']['psp11'] ?>],
                      ['PSP 2.0', <?php echo $this->data['proyecto']['sumaTiempoProceso']['psp20'] ?>],
                      ['PSP 2.1', <?php echo $this->data['proyecto']['sumaTiempoProceso']['psp21'] ?>],
                    ]);

                    var options = {
                      title: 'Desarrollo del tiempo',
                      is3D: true,
                      legend: {position: 'bottom', textStyle: {fontSize: 13, bold: true}},
                    };
                    var chart = new google.visualization.BarChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                  }
              </script>
            </div>
          </div>
          <div class="col-12 col-lg-6 graficaChart p-4">
            <div  style="width: 100%; height: 40vh" id="piechart2">
              <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Task','Tiempos'],
                      ['Planeación',  <?php echo $this->data['proyecto']['tiempoPorc']['fase01'] ?>],
                      ['Compilación', <?php echo $this->data['proyecto']['tiempoPorc']['fase06'] ?>],
                      ['Pruebas Un.', <?php echo $this->data['proyecto']['tiempoPorc']['fase07'] ?>],
                      ['PostMortem',  <?php echo $this->data['proyecto']['tiempoPorc']['fase08'] ?>],
                    ]);

                    var options = {
                      title: 'Tiempos',
                      is3D: true,
                      legend: {position: 'right', textStyle: {fontSize: 13, bold: true}},
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

                    chart.draw(data, options);
                  }
              </script>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-6 graficaChart p-4">
            <div  style="width: 100%; height: 40vh" id="piechart3">
              <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'Valor'],
                      ['Planeación',  <?php echo $this->data['proyecto']['tiempoPlaneacion']['fase01'] ?>],
                      ['PostMortem',  <?php echo $this->data['proyecto']['tiempoPlaneacion']['fase08'] ?>],
                    ]);

                    var options = {
                      title: 'Tiempo de planeación',
                      is3D: true,
                      legend: {position: 'left', textStyle: {fontSize: 13, bold: true}},
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart3'));

                    chart.draw(data, options);
                  }
              </script>
            </div>
          </div>
          <div class="col-12 col-lg-6 graficaChart p-4">
            <div  style="width: 100%; height: 40vh" id="piechart4">
              <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'No. Errores'],
                      ['Diseño',  <?php echo $this->data['proyecto']['defectosInyectados']['fase02'] ?>],
                      ['Código',  <?php echo $this->data['proyecto']['defectosInyectados']['fase04'] ?>],
                    ]);

                    var options = {
                      title: 'Defectos inyectados en:',
                      is3D: true,
                      legend: {position: 'bottom', textStyle: {fontSize: 13, bold: true}},
                    };
                    var chart = new google.visualization.BarChart(document.getElementById('piechart4'));

                    chart.draw(data, options);
                  }
              </script>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-6 graficaChart p-4">
            <div  style="width: 100%; height: 40vh" id="piechart5">
              <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'No. Defectos'],

                      ['Diseño Rev.',  <?php echo $this->data['proyecto']['defectosRemovidos']['fase03'] ?>],
                      ['Código',  <?php echo $this->data['proyecto']['defectosRemovidos']['fase04'] ?>],
                      ['Compilación',  <?php echo $this->data['proyecto']['defectosRemovidos']['fase06'] ?>],
                      ['Pruebas Uni.',  <?php echo $this->data['proyecto']['defectosRemovidos']['fase07'] ?>],
                    ]);

                    var options = {
                      title: 'Defectos removidos en:',
                      is3D: true,
                      legend: {position: 'bottom', textStyle: {fontSize: 13, bold: true}},
                    };
                    var chart = new google.visualization.BarChart(document.getElementById('piechart5'));

                    chart.draw(data, options);
                  }
              </script>
            </div>
          </div>
          <div class="col-12 col-lg-6 graficaChart p-4">
            <div  style="width: 100%; height: 40vh" id="piechart6">
              <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'No. Defectos'],
                      ['Compilación',  <?php echo $this->data['proyecto']['defectosRemovidos']['fase06'] ?>],
                      ['Pruebas Uni.',  <?php echo $this->data['proyecto']['defectosRemovidos']['fase07'] ?>],
                    ]);

                    var options = {
                      title: 'Defectos removidos en',
                      is3D: true,
                      legend: {position: 'bottom', textStyle: {fontSize: 13, bold: true}},
                    };
                    var chart = new google.visualization.BarChart(document.getElementById('piechart6'));

                    chart.draw(data, options);
                  }
              </script>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-6 graficaChart p-4">
            <div  style="width: 100%; height: 40vh" id="piechart7">
              <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'No. Defectos'],
                      ['Documentación',    <?php echo $this->data['proyecto']['defectosTipo']['error01'] ?>],
                      ['Sintaxis/Estatica',<?php echo $this->data['proyecto']['defectosTipo']['error02'] ?>],
                      ['Compilación',      <?php echo $this->data['proyecto']['defectosTipo']['error03'] ?>],
                      ['Asignación',       <?php echo $this->data['proyecto']['defectosTipo']['error04'] ?>],
                      ['Interfaz',         <?php echo $this->data['proyecto']['defectosTipo']['error05'] ?>],
                      ['Comprobación',     <?php echo $this->data['proyecto']['defectosTipo']['error06'] ?>],
                      ['Datos',            <?php echo $this->data['proyecto']['defectosTipo']['error07'] ?>],
                      ['Función',          <?php echo $this->data['proyecto']['defectosTipo']['error08'] ?>],
                      ['Temporización',    <?php echo $this->data['proyecto']['defectosTipo']['error09'] ?>],
                      ['Entorno' ,         <?php echo $this->data['proyecto']['defectosTipo']['error10'] ?>],
                    ]);

                    var options = {
                      title: 'Defectos removidos por tipo',
                      is3D: true,
                      legend: {position: 'bottom', textStyle: {fontSize: 13, bold: true}},
                    };
                    var chart = new google.visualization.BarChart(document.getElementById('piechart7'));

                    chart.draw(data, options);
                  }
              </script>
            </div>
          </div>
          <div class="col-12 col-lg-6 graficaChart p-4">
            <div  style="width: 100%; height: 40vh" id="piechart8">
              <script type="text/javascript">
                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'Minutos Defectos'],
                      ['Documentación',    <?php echo $this->data['proyecto']['defectosTiempo']['error01'] ?>],
                      ['Sintaxis/Estatica',<?php echo $this->data['proyecto']['defectosTiempo']['error02'] ?>],
                      ['Compilación',      <?php echo $this->data['proyecto']['defectosTiempo']['error03'] ?>],
                      ['Asignación',       <?php echo $this->data['proyecto']['defectosTiempo']['error04'] ?>],
                      ['Interfaz',         <?php echo $this->data['proyecto']['defectosTiempo']['error05'] ?>],
                      ['Comprobación',     <?php echo $this->data['proyecto']['defectosTiempo']['error06'] ?>],
                      ['Datos',            <?php echo $this->data['proyecto']['defectosTiempo']['error07'] ?>],
                      ['Función',          <?php echo $this->data['proyecto']['defectosTiempo']['error08'] ?>],
                      ['Temporización',    <?php echo $this->data['proyecto']['defectosTiempo']['error09'] ?>],
                      ['Entorno' ,         <?php echo $this->data['proyecto']['defectosTiempo']['error10'] ?>],
                    ]);

                    var options = {
                      title: 'Tiempo en cada error',
                      is3D: true,
                      legend: {position: 'bottom', textStyle: {fontSize: 13, bold: true}},
                    };
                    var chart = new google.visualization.BarChart(document.getElementById('piechart8'));

                    chart.draw(data, options);
                  }
              </script>
            </div>
          </div>
        </div>
      </div>
</section>

<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
