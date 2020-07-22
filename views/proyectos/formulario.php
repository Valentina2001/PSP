<?php $title = "Proyectos | Nuevo"; include_once "views/head.php"; include_once "views/header.php"?>

<section class="section pt-4">
  <form name="formulario" method="POST"  action="<?php echo constant('URL') ?>/proyectos/crear">
    <div class="container px-3 col-md-5">
        <div class="p-0 m-0 titulo-formulario d-flex justify-content-center " >
          <h1>Gestión Proyecto</h1>
        </div>
        <div class="flex-column pr-0">
          <div class="form-group">
            <input type="text" name="idProyecto" value="<?php echo $this->data['idProyecto'] ?>" class="hide">
          </div>
          <div class="form-group">
            <input type="text" class="form-control " placeholder="Nombre del proyecto" name="nombre" value="<?php echo $this->data['nombre'] ?>">
          </div>
          <div class="form-group">
            <select class="custom-select form-control" name="idProceso">
              <?php
                $option = $this->listProcesos;
                foreach ($option as $proceso) {
                  if($proceso['idProceso'] == $this->data['idProceso']){
                    echo '<option value="'.$proceso['idProceso'].'" selected>'.$proceso['nombre'].'</option>';
                  }else{
                    echo '<option value="'.$proceso['idProceso'].'">'.$proceso['nombre'].'</option>';
                  }
                }
              ?>
            </select>
          </div>
          <div class="input-group mt-0">
            <?php echo "<input type='text' id='listInput' value='".$this->data['idLenguaje']."' class='d-none'>"; ?>
            <select class="custom-select" id="list-select" name="idLenguaje">
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
          <div class="form-group">
            <select class="custom-select form-control" name="idMedida">
              <?php
                $option = $this->listMedidas;
                foreach ($option as $medida) {
                  if($medida['idMedida'] == $this->data['idMedida']){
                    echo '<option value="'.$medida['idMedida'].'" selected>'.$medida['nombre'].'</option>';
                  }else{
                    echo '<option value="'.$medida['idMedida'].'">'.$medida['nombre'].'</option>';
                  }
                }
              ?>
            </select>
            <!-- <input type="text" class="form-control" placeholder="Medida" name="medida"> -->
          </div>
          <div class="form-group">
            <?php
              if($this->data['fechaIn'] != ""){
                echo '<input type="date" class="form-control" placeholder="Fecha creación" name="fechaIn" value="'.$this->data['fechaIn'] .'" disabled data-date=""  data-date-format="DD MMMM YYYY">';
              }
            ?>
          </div>
          <div class="form-group d-flex flex-wrap">
            <input type="date" class="form-control" placeholder="Fecha Culminación" name="fechaOut" data-date=""  data-date-format="DD MMMM YYYY" value="<?php echo $this->data['fechaOut'] ?>">
          </div>
          <div class="form-group d-flex flex-wrap">
            <textarea name="descripcion" rows="8" cols="80" class="form-control" name="descripcion" ><?php echo $this->data['descripcion']; ?></textarea>
          </div>
          <div class="form-group text-center d-flex justify-content-around align-items-center">
            <a href="<?php echo constant('URL') ?>/proyectos" class="btn btn-link">regresar</a>
            <a href="<?php echo constant('URL').'/proyectos/asociar/'.$this->data['idProyecto']?>" class="btn btn-outline-primary">Asociar programador</a>
            <a href="<?php echo constant('URL').'/proyectos/eliminar/'.$this->data['idProyecto']?>" class="btn btn-outline-danger" id="cta">Eliminar</a>
            <button type="submit" class="btn btn-success" id="cta">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
<?php
  include_once "views/footer.php";
  include_once "views/modalCambioPassword.php";
?>
