
<?php $sesionData = $this->sesion->getSesion('usuario'); ?>

<header class="header">
    <div class="header__logo">
      <!-- <button id="btn-menu" class="btn-menu"></button> -->
        <i class="icon" id="header-menu"><i class="fas fa-bars"></i></i>
        <img src="<?php echo constant('URL') ?>public/img/logos/favicon.png" alt="" class="">
    </div>
    <div class="header__user">
      <i class="fas fa-user" id="btn-perfil"></i>
      <div class="header__user-menu">
        <img src="<?php echo constant('URL') .$sesionData[2] ?>" class="header__user-menu--img" alt="usuario">
        <h5><b><?php echo $sesionData[0] ?></b></h5>
        <h6 class="text-muted"><?php echo $sesionData[1] ?></h6>
        <ul>
          <li><a href="<?php echo constant('URL') . "programador/formulario/".$sesionData[3] ?>"><i class="btn-icon fas fa-user-edit"></i>Editar Información</a></li>
          <li><a href=""  data-toggle="modal" data-target="#cambioUsuario"><i class="btn-icon fas fa-eye"></i>Cambiar contraseña</a></li>
          <li><a href="<?php echo constant('URL') ?>login/cerrarSesion"><i class="btn-icon fas fa-times-circle"></i>Cerrar sesión</a></li>
        </ul>
        <li class="switch" >
          <a href="#">
            <p>Tema:</p>
            <button id="switch">
    					<span><i class="fas fa-sun"></i></span>
    					<span><i class="fas fa-moon"></i></span>
    				</button>
          </a>
        </li>
      </div>
    </div>
</header>

<div class="container-full">
<?php include_once "views/aside.php" ?>
