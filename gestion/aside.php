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
                  <div class="aside__link"><i class="aside__icon left fas fa-project-diagram"></i><a href="#" >Reportes</a></div>
              </li>
              ';
              break;
            case 'programador':
              echo '
              <li class="aside__item">
                  <div class="aside__link"><i class="aside__icon left fas fa-laptop-code"></i><a href="'.constant('URL').'" >Inicio</a></div>
              </li>
              <li class="aside__item">
                  <div class="aside__link"><i class="aside__icon left  fas fa-folder"></i><a href="#" >Proyectos</a></div>
              </li>
              <li class="aside__item">
                  <div class="aside__link"><i class="aside__icon left fas fa-chart-bar"></i><a href="#" >Reportes</a></div>
              </li>
              ';
            default:

              break;
          }

        ?>
        <!-- administrador -->

    </ul>
    <p class="aside__description">© 2020-1</p>
</aside>
