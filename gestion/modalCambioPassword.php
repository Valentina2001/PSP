<div class="modal fade" id="cambioUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <?php
            if($this->sesion->getSesion('usuario')[4] == 'programador' ){
              echo '<form method="post" action="'.constant('URL') .'programador/cambiarPassword" class="login__content">';
            }else{
              echo '<form method="post" action="'.constant('URL') .'administrador/cambiarPassword" class="login__content">';
            }
          ?>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Contraseña actual" name="actualPassword">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Nueva contraseña" id="password" name="nuevaPassword">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirmar contraseña" id="password2" name="confirmPassword" disabled>
          </div>
          <span id="text_password2" class="form-text "></span>
          <input type="submit" class="hide" id="ctaGuardar">

        </form>
      </div>
      <div class="modal-footer">
        <!-- <button href="#" class="btn btn-success">Guardar</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <label for="ctaGuardar" class="btn btn-success mt-2">Guardar Cambios</label>
      </div>
    </div>
  </div>
</div>
