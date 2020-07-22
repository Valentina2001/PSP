<?php
	class LoginModel extends Model{
		function __construct(){
			parent::__construct();
		}

		function validarAdmin($usuario){
			$query = $this->db->connect()->query("SELECT * FROM administradores WHERE usuario = '$usuario'");

			$data = [];
			while ($row = $query->fetch()){
				$item = [
					'cedula' => $row['cedulaAdministrador'],
					'nombre' => $row['nombre'],
					'apellido' => $row['apellido'],
					'email' => $row['email'],
					'foto' => $row['foto'],
					'usuario' => $row['usuario'],
					'password' => $row['password']
				];
				array_push($data, $item);
			};
			return $data;
		}

		function validarUsuario($usuario){
			$query = $this->db->connect()->query("SELECT * FROM usuarios WHERE user = '$usuario'");

			$data = [];
			while ($row = $query->fetch()){
				$item = [
					'cedula' => $row['cedulaUsuario'],
					'nombre' => $row['nombre'],
					'apellido' => $row['apellido'],
					'email' => $row['email'],
					'foto' => $row['foto'],
					'usuario' => $row['user'],
					'password' => $row['password'],
					'estado' => $row['estado'],
				];
				array_push($data, $item);
			};
			return $data;
		}
	}

?>
