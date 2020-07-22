<?php $title = "Programadores | Aspirantes al proyeto"; include_once "views/head.php"; include_once "views/header.php"?>

<section class="section">
    <div class="content py-3 px-4">
      <?php
      if(empty($this->data)){
        echo "
        <div class='alert alert-warning'>
        <h4 class='alert-heading'>Personal Software Process</h4>
        <p>Al parecer no hay ningún registro de programadores</p>
        </div>
        ";

        include_once "views/footer.php";
        include_once "views/modalCambioPassword.php";
        die;
      }
      ?>
        <div class="content__head">
          <div class="content__select col-md-6">
            <div class="alert alert-info ">
              <h5>Detalles de asociados en el proyecto</h5>
              <ul class="float-left">
                <li>Total de asociados: <?php echo $this->totalAsociados[0]; ?></li>
              </ul>
            </div>
          </div>
          <div class="content__search pb-4">
            <div class="input-group">
              <input type="text" class="form-control " id="search" placeholder="Buscar aspirantes x cedula">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="content__info">
            <div class="table" >
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                      <tr>
                        <th scope="col">Cedula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo electronico</th>
                        <th scope="col">Usuario</th>
                        <th scope="col" colspan="2">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $option = [
                                  'titulo01' => 'Developer Junior',
                                  'titulo02' => 'Developer Senior'
                                ];
                                for ($i = 0; $i < count($this->data); $i++){
                                    echo "<tr><td id='Dcedula' class='cedulas'>" . $this->data[$i]['cedula'] . "</td>";
                                    echo "<td id='Dnombre'>" . $this->data[$i]['nombre'] . "</td>";
                                    echo "<td id='Dapellido'>" . $this->data[$i]['apellido'] . "</td>";
                                    echo "<td id='Demail'>" . $this->data[$i]['email'] . "</td>";
                                    echo "<td id='Duser'>" . $this->data[$i]['user'] . "</td>";

                                    echo "<td id='Dempresa'class='hide'>" . $this->data[$i]['empresa'] . "</td>";
                                    echo "<td id='Dexperiencia' class='hide'>" . $this->data[$i]['experiencia'] . " año(s)</td>";

                                    if($this->data[$i]['estado']){
                                      echo "<td id='Dproyecto' class='hide'>Permitido(a)</td>";
                                    }else{
                                      echo "<td id='Dproyecto' class='hide'>No permitido(a)</td>";
                                    }

                                    echo "<td id='Dfoto' class='hide'>" . $this->data[$i]['foto'] . "</td>";

                                    foreach ($option as $key => $value) {
                                      if($this->data[$i]['titulo'] == $key){
                                        echo "<td id='Dtitulo' class='hide'>" . $value . "</td>";
                                      }
                                    }

                                    echo "<td><a href='#' data-toggle='modal' class='btn btn-outline-primary visualizar-modal fas fa-info' data-target='#detallesProgramador' ></a>";

                                    if($this->data[$i]['asociado'] == null){
                                      echo "</td><td><a href='".constant('URL')."proyectos/asociando/".$this->data[$i]['cedula']."/".$this->idProyecto."' class='btn btn-link far fa-square'></a> </td> </tr>";
                                    }else{
                                      echo "<td id='DidProyecto' class='d-none'>". $this->data[$i]['asociado']['idProyecto'] . "</td>";
                                      echo "</td><td><a href='".constant('URL')."proyectos/desasociar/".$this->data[$i]['cedula']."/".$this->idProyecto."' class='btn btn-link far fa-check-square'></a> </td> </tr>";
                                    }
                                }
                            ?>
                        </tr>
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="float-right">
              <?php echo "Total: ".count($this->data) ?>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="detallesProgramador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-primary ">
                        <h5 class="modal-title text-light" id="exampleModalLabel">Personal Software Process</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="row container">
                            <div class="col-md-5 formulario_imagen">
                                <img src="<?php echo constant('URL') ?>" alt="" id="img_user">
                            </div>
                            <div class="col-md-7">
                                <div class="input-group mb-2">
                                    <input type="text" disabled id="nombre" placeholder="Nombres Completo" class="form-control mr-2" >
                                    <input type="text" disabled id="apellido" placeholder="Apellidos Completo" class="form-control ml-2" >
                                </div>
                                <input type="email" disabled placeholder="Correo electronico" class="form-control mt-2" id="email">
                                <div class="input-group my-2">
                                    <input type="text" disabled placeholder="Empresa" class="form-control mr-2" id="empresa">
                                    <input type="text" disabled placeholder="Experiencia" class="form-control ml-2" id="experiencia">
                                </div>
                                <input type="text" disabled placeholder="Titulo" class="form-control mt-2" id="titulo">
                                <div class="input-group my-2">
                                    <input type="text" disabled placeholder="Usuario" class="form-control mr-2" id="usuario">
                                    <input type="text" disabled placeholder="Proyecto" class="form-control ml-2" id="proyecto">
                                </div>
                            </div>
                        </form>
                    <div class="modal-footer">
                        <a href="<?php echo constant('URL') ?>programador/formulario/" class="btn btn-secondary" id="ctaV">Editar información</a>
                        <a href="<?php echo constant('URL') ?>" class="btn btn-primary" id="ctaP">Ver proyecto</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?php  include_once "views/modalCambioPassword.php"; ?>
<?php  include_once "views/footer.php";?>
