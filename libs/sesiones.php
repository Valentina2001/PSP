<?php
	class Sesiones{
		function __construct(){
		}
		function sesionStart(){
			session_start();
		}
		function setSesion($nombre, $valor){
			$_SESSION[$nombre] = $valor;
		}

		function getSesion($nombre){
			if(isset($_SESSION[$nombre])){
				return $_SESSION[$nombre];
			}

			return -1;
		}

		function unset($nombre){
			unset($_SESSION[$nombre]);
		}

		function delSesion(){
			session_destroy();
		}
	}



?>
