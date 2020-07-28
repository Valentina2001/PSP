<?php $title = "Programadores | Actualizar"; include_once "views/head.php"; include_once "views/header.php"?>
<section class="section">
  <div class="swiper-container">
    <form  action="<?php echo constant('URL') ?>programador/update" method="POST"  class="swiper-wrapper" enctype="multipart/form-data">
      <input type="text" name="cedula" value="<?php echo $this->data['cedula'] ?>" class="hide">
      <div class="swiper-slide">
        <div class="container p-0 m-0">
          <div class="p-0 m-0 titulo-formulario d-flex justify-content-center" >
            <h1>Información personal</h1>
          </div>
          <div class="row">
            <div class="col-md-4 formulario_imagen">
              <img src="<?php echo constant('URL').$this->data['foto']; ?>" alt="" id="img_user">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="input_user" name="foto">
                <label class="custom-file-label" for="input_user">Seleccionar foto</label>
              </div>
            </div>
            <div class="col-md-7 ab-center flex-column  pr-0">
              <div class="input-group">
                <input name="nombre" type="text" placeholder="Nombres Completo" class="form-control mr-2" value="<?php echo $this->data['nombre'] ?>" >
                <input name="apellido" type="text" placeholder="Apellidos Completo" class="form-control" value="<?php echo $this->data['apellido'] ?>">
              </div>
              <input name="email" type="email" placeholder="Correo electronico" class="form-control" value="<?php echo $this->data['email'] ?>">
              <div class="input-group">
                <input name="empresa" type="text" placeholder="Empresa" class="form-control mr-2" value="<?php echo $this->data['empresaNombre'] ?>">
                <input name="experiencia" type="text" placeholder="Experiencia" class="form-control" value="<?php echo $this->data['experiencia'] ?> año(s)">
              </div>
              <input name="enfoque" type="text" placeholder="Enfoque profesional" class="form-control" value="<?php echo $this->data['enfoqueEstudios'] ?>">
              <div class="input-group">
                <input name="tituloProfesional" type="text" placeholder="Título profesional" class="form-control mr-2" value="<?php echo $this->data['tituloEstudio'] ?>">
                <select class="custom-select form-control" id="ambito" name="tituloDesarrollo">
                  <?php
                    $option = [
                      'titulo01' => 'Developer Junior',
                      'titulo02' => 'Developer Senior'
                    ];
                    foreach ($option as $key => $value) {
                      if($this->data['titulo'] == $key){
                        echo "<option value='$key' selected>$value</option>";
                      }else{
                        echo "<option value='$key'>$value</option>";
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-slide">
          <div class="container p-0 m-0">
              <div class="p-0 m-0 titulo-formulario d-flex justify-content-center" >
                  <h1>Experiencia</h1>
              </div>
              <div class="row mt-4">
                  <div class="col-sm-12 col-md-6">
                    <input type="text" name="idExpSoftware" value="<?php echo $this->data['idExpSoftware']; ?>" class="hide">
                    <div class="alert alert-success" role="alert">
                      <p>Los siguientes campos deben ser ingresados en años, dependiendo la experiencia que tenga en cada uno de ellos</p>
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="ambito">Ámbito</label>
                      </div>
                      <select class="custom-select form-control" id="ambito" name="idHambito">
                        <?php
                          $option = [
                            'hambito01' => 'Front End',
                            'hambito02' => 'Back end',
                            'hambito03' => 'Full Stack'
                          ];
                          foreach ($option as $key => $value) {
                            if($this->data['idHambito'] == $key){
                              echo "<option value='$key' selected>$value</option>";
                            }else{
                              echo "<option value='$key'>$value</option>";
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="input-group">
                      <input type="text" name="pidExpPorcentual" value="<?php echo $this->data['pidExpPorcentual']; ?>" class="hide">
                      <input name="empresa" type="INT" placeholder="Empresa" class="form-control mr-2" value="<?php echo $this->data['empresa'] ?>">
                      <input name="cargo" type="INT" placeholder="Cargo" class="form-control" value="<?php echo $this->data['cargo'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="experiencia" type="INT" placeholder="Experiencia" class="form-control mr-2" value="<?php echo $this->data['experiencia'] ?>">
                      <input name="requerimientos" type="INT" placeholder="Requerimientos" class="form-control" value="<?php echo $this->data['requerimientos'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="design" type="INT" placeholder="Diseño" class="form-control mr-2" value="<?php echo $this->data['design'] ?>">
                      <input name="calidad" type="INT" placeholder="Calidad software" class="form-control" value="<?php echo $this->data['calidad'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="ut" type="INT" placeholder="Pruebas unitarias" class="form-control mr-2" value="<?php echo $this->data['ut'] ?>">
                      <input name="testing" type="INT" placeholder="Testing" class="form-control" value="<?php echo $this->data['testing'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="gestionCalidad" type="INT" placeholder="Gestión de calidad" class="form-control mr-2" value="<?php echo $this->data['gestionCalidad'] ?>">
                      <input name="gestionConfig" type="INT" placeholder="Gestión condiguración" class="form-control" value="<?php echo $this->data['gestionConfig'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="alert alert-success" role="alert">
                      <p>En el año anterior cuanto tiempo le dedico a cada una de las áreas a continuación. La respuesta en un rango de 0 a 100%</p>
                    </div>
                    <div class="input-group">
                      <input  name="pempresa" type="number" min="0" max="100" class="form-control " placeholder="Empresa" value="<?php echo $this->data['pempresa'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="pcargo" type="number" min="0" max="100" class="form-control " placeholder="Cargo" value="<?php echo $this->data['pcargo'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="prequerimientos" type="number" min="0" max="100" class="form-control " placeholder="Requerimientos" value="<?php echo $this->data['prequerimientos'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="pcalidad" type="number" min="0" max="100" class="form-control " placeholder="Calidad" value="<?php echo $this->data['pcalidad'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="pgestionConfig" type="number" min="0" max="100" class="form-control " placeholder="Gestion de configuración" value="<?php echo $this->data['pgestionConfig'] ?>">
                    </div>
                    <div class="input-group">
                      <input name="pgestionCalidad" type="number" min="0" max="100" class="form-control " placeholder="Gestion de calidad" value="<?php echo $this->data['pgestionCalidad'] ?>">
                    </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="swiper-slide">
        <div class="container p-0 m-0">
          <div class="p-0 m-0 titulo-formulario d-flex justify-content-center" >
            <h1>Lenguajes</h1>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6 mt-4">
              <p>¿En que lenguajes progamas?</p>
              <!-- <input type="text" class="form-control mb-2" placeholder="¿En que lenguajes programas?" disabled> -->
              <div class="list-group list-group-formulario">
                <a href="#" class="list-group-item">
                  <input type="text" name="idExpProgramando" value="<?php echo $this->data['idExpProgramando']; ?>" class="hide">
                  <input type="search" class="form-control" id="search" placeholder="Buscar lenguaje">
                </a>
                <ul id="list-lenguajes">
                   <!-- bg-primary lenguaje-active -->
                  <?php
                    $this->lenguajes = $this->data['lenguajes'];
                    $this->lenguajes = rtrim($this->lenguajes, ',');
                    $this->lenguajes = explode(',', $this->lenguajes);
                    for($i = 0; $i < count($this->listLenguajes); $i++){
                    // foreach ($this->listLenguajes as $lenguaje ){
                      if(in_array($this->listLenguajes[$i]['nombre'], $this->lenguajes)){
                        echo "<label class='list-group-item text-muted m-0 bg-primary lenguaje-active' for='".$this->listLenguajes[$i]['idLenguaje']."'><input type='checkbox' class='lenguajes hide' id='".$this->listLenguajes[$i]['idLenguaje']."'> <span class='lenguaje'>".$this->listLenguajes[$i]['nombre']."</span> </label>";
                      }else{
                        echo "<label class='list-group-item text-muted m-0' for='".$this->listLenguajes[$i]['idLenguaje']."'><input type='checkbox' class='lenguajes hide' id='".$this->listLenguajes[$i]['idLenguaje']."'> <span class='lenguaje'>".$this->listLenguajes[$i]['nombre']."</span> </label>";
                      }
                    }
                  ?>
                </ul>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 mt-4 ">
              <div class="list-group list-group-formulario mb-2" >
                <input type="text" name="listLenguajes" value="No hay lenguajes" class="form-control d-none" id="list-conocimiento">
              </div>
              <p class="mb-0">Número de líneas escritas en todos los lenguajes</p>
              <input type="number" name="lenguajesLDC" min="0" placeholder="LDC en todos los programas" class="form-control mt-0 mb-3 " value="<?php echo $this->data['lenguajesLDC'] ?>">

              <p class="mt-2 mb-0">Lenguaje que mejor manejas</p>
              <div class="input-group mt-0">
                <?php echo "<input type='text' id='listInput' value='".$this->data['idLenguaje']."' class='d-none'>"; ?>
                <select class="custom-select" id="list-select" name="lenguaje">
                  <?php
                    foreach ($this->listLenguajes as $lenguaje ){
                      if($lenguaje['idLenguaje'] == $this->data['idLenguaje']){
                        echo "<option value='".$lenguaje['idLenguaje']."' selected>".$lenguaje['nombre']."</option>";
                      }else{
                        echo "<option value='".$lenguaje['idLenguaje']."'>".$lenguaje['nombre']."</option>";
                      }
                    }
                  ?>
                </select>
              </div>
              <input type="number" name="lenguajeLDC" min="0" placeholder="LDC en este lenguaje" class="form-control" value="<?php echo $this->data['lenguajeLDC'] ?>">
            </div>
            </div>
          </div>
        </div>
        <input type="submit" class="hide" id="ctaGuardar">
    </form>

  <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
<!-- Add Arrows -->
    <div class="swiper-footer row my-2">
      <div class="cta-navigation col-sm-2">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
      <div class="btn-action col-sm-10 ">
        <a href="<?php echo constant('URL') ?>programador" class="btn btn-outline-danger">Cancelar</a>
        <label for="ctaGuardar" class="btn btn-success mt-2">Guardar</label>
      </div>
    </div>
  </div>
</section>

<?php  include_once "views/modalCambioPassword.php"; ?>
<?php include_once "views/footer.php"; ?>
