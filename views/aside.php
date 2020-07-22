<aside class="aside">
    <ul class="aside__container">
        <?php
          $rol = $this->sesion->getSesion('usuario')[4];

          switch ($rol) {
            case 'administrador':
              echo '
              <li class="aside__item activo">
                  <div class="aside__link"><i class="aside__icon left fas fa-folder"></i><a href="'.constant('URL').'proyectos" >Proyectos</a></div>
              </li>
              <li class="aside__item">
                <div class="aside__link"><i class="aside__icon left fas fa-users"></i><a href="#" >Programadores</a></i><i class="aside__icon fas fa-caret-down rigth"></i></div>
                <ul class="aside__content-list">
                  <li class="aside__content-item"><a href="'.constant('URL').'programador/aspirantes" class="aside__link"><i class="aside__icon fas fa-minus left"></i>Aspirantes</a></li>
                  <li class="aside__content-item"><a href="'.constant('URL').'programador/admitidos" class="aside__link"><i class="aside__icon fas fa-check left"></i>Admitidos</a></li>
                  <li class="aside__content-item"><a href="'.constant('URL').'programador/rechazados" class="aside__link"><i class="aside__icon fas fa-times left"></i>  Rechazados</a></li>
                </ul>
              </li>
              <li class="aside__item">
                  <div class="aside__link"><i class="aside__icon left fas fa-project-diagram"></i><a href="'.constant('URL').'lenguajes" >Lenguajes</a></div>
              </li>
              <li class="aside__item">
                  <div class="aside__link"><i class="aside__icon left fas fa-chart-bar"></i><a href="#" >Reportes</a></div>
              </li>
              ';
              break;
            case 'programador':
              echo '
              <li class="aside__item">
                  <div class="aside__link"><i class="aside__icon left  fas fa-folder"></i><a href="'.constant('URL').'" >Proyectos</a></div>
              </li>
              ';
                if(isset($this->gestionProyecto) and $this->gestionProyecto != -1){
                  switch ($this->gestionProyecto['proceso']) {
                    case 'psp0':
                      echo '
                        <li class="aside__item">
                            <div class="aside__link"><i class="aside__icon left  fas fa-stopwatch"></i><a href="'.constant('URL').'" >Tiempos</a></div>
                        </li>
                        <li class="aside__item">
                            <div class="aside__link"><i class="aside__icon left  fas fa-bug"></i><a href="'.constant('URL').'" >Errores</a></div>
                        </li>
                        <li class="aside__item">
                            <div class="aside__link"><i class="aside__icon left  fas fa-viruses"></i><a href="'.constant('URL').'" >Tipo errores</a></div>
                        </li>
                      ';
                      break;
                    case 'psp01':
                      echo '
                        <li class="aside__item">
                            <div class="aside__link"><i class="aside__icon left  fas fa-stopwatch"></i><a href="'.constant('URL').'" >Tiempos</a></div>
                        </li>
                        <li class="aside__item">
                            <div class="aside__link"><i class="aside__icon left  fas fa-bug"></i><a href="'.constant('URL').'" >Errores</a></div>
                        </li>
                        <li class="aside__item">
                            <div class="aside__link"><i class="aside__icon left  fas fa-viruses"></i><a href="'.constant('URL').'" >Tipo errores</a></div>
                        </li>
                        <li class="aside__item">
                            <div class="aside__link"><i class="aside__icon left  fas fa-exclamation-triangle"></i><a href="'.constant('URL').'" >PIP</a></div>
                        </li>
                        <li class="aside__item">
                            <div class="aside__link"><i class="aside__icon left  fas fa-file-invoice"></i><a href="'.constant('URL').'" >Reportes</a></div>
                        </li>
                      ';
                      break;
                    default:
                      // code...
                      break;
                  }

                  echo '
                    <li class="aside__item">
                        <div class="aside__link"><i class="aside__icon left  fas fa-external-link-alt"></i><a href="'.constant('URL').'gestionProyecto/cerrarProyecto" >Cerrar proyecto</a></div>
                    </li>
                  ';
                }else{
                  echo '
                  <li class="aside__item">
                  <div class="aside__link"><i class="aside__icon left fas fa-chart-bar"></i><a href="#" >Reportes generales</a></div>
                  </li>
                  ';
                }


              break;

            default:
              break;
          }

        ?>
        <!-- administrador -->

    </ul>
    <p class="aside__description">© 2020-1</p>
</aside>
