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
            <a href="#" class="btn btn-outline-primary fas fa-search buscar-reporte"></a>
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
                      ['PSP 0.0', 5],
                      ['PSP 0.1', 5],
                      ['PSP 1.0', 5],
                      ['PSP 1.1', 5],
                      ['PSP 2.0', 5],
                      ['PSP 2.1', 5],
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
                      ['Task', 'Plan inyectados', 'Actual inyectados'],
                      ['Planeación',  5, 2],
                      ['Diseño',      5, 2],
                    ]);

                    var options = {
                      title: 'Defec. por face vs plan defec. fase',
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
                      ['Task', 'Plan inyectados', 'Actual inyectados'],
                      ['Planeación',  5, 2],
                      ['Diseño',      5, 2],
                    ]);

                    var options = {
                      title: 'Defec. por face vs plan defec. fase',
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
                      ['Task', 'Plan inyectados', 'Actual inyectados'],
                      ['Planeación',  5, 2],
                      ['Diseño',      5, 2],
                    ]);

                    var options = {
                      title: 'Defec. por face vs plan defec. fase',
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
                      ['Task', 'Plan inyectados', 'Actual inyectados'],
                      ['Planeación',  5, 2],
                      ['Diseño',      5, 2],
                    ]);

                    var options = {
                      title: 'Defec. por face vs plan defec. fase',
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
                      ['Task', 'Plan inyectados', 'Actual inyectados'],
                      ['Planeación',  5, 2],
                      ['Diseño',      5, 2],
                    ]);

                    var options = {
                      title: 'Defec. por face vs plan defec. fase',
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
                      ['Task', 'Plan inyectados', 'Actual inyectados'],
                      ['Planeación',  5, 2],
                      ['Diseño',      5, 2],
                    ]);

                    var options = {
                      title: 'Defec. por face vs plan defec. fase',
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
                      ['Task', 'Plan inyectados', 'Actual inyectados'],
                      ['Planeación',  5, 2],
                      ['Diseño',      5, 2],
                    ]);

                    var options = {
                      title: 'Defec. por face vs plan defec. fase',
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
