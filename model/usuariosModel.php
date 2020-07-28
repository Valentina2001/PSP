<?php
	class UsuariosModel extends Model{
		function __construct(){
			parent::__construct();
		}

		function eliminarHistorial($codigo){
			$this->db->connect()->query("DELETE FROM deteccionerrores WHERE idProyectoUsuario = $codigo");
			$this->db->connect()->query("DELETE FROM pip WHERE idProyectoUsuario = $codigo");
			$this->db->connect()->query("DELETE FROM reportes WHERE idProyectoUsuario = $codigo");
			$this->db->connect()->query("DELETE FROM tiempos WHERE idProyectoUsuario = $codigo");
			$this->db->connect()->query("DELETE FROM tiempos WHERE idProyectoUsuario = $codigo");

		}

		function eliminar($cedula){
			$this->db->connect()->query("DELETE FROM expporcentual WHERE cedulaUsuario = '$cedula'");
			$this->db->connect()->query("DELETE FROM expprogramando WHERE cedulaUsuario = '$cedula'");
			$this->db->connect()->query("DELETE FROM expsoftware WHERE cedulaUsuario = '$cedula'");
			$this->db->connect()->query("DELETE FROM proyectosusuarios WHERE cedulaUsuario = '$cedula'");
			$this->db->connect()->query("DELETE FROM usuarios WHERE cedulaUsuario = '$cedula'");
		}

		function getUsuario($cedula){
			$informacionBase = $this->db->connect()->query("SELECT * FROM usuarios WHERE cedulaUsuario = '$cedula[0]'");
			$expSoftware = $this->db->connect()->query("SELECT * FROM expsoftware WHERE cedulaUsuario = '$cedula[0]'");
			$expPorcentual = $this->db->connect()->query("SELECT * FROM expporcentual WHERE cedulaUsuario = '$cedula[0]'");
			$expProgramando = $this->db->connect()->query("SELECT * FROM expprogramando WHERE cedulaUsuario = '$cedula[0]'");

			$data = [];
			while ($row = $informacionBase->fetch()){
				$item = [
					'cedula' => $row['cedulaUsuario'],
					'nombre' => $row['nombre'],
					'apellido' => $row['apellido'],
					'empresa' => $row['empresa'],
					'email' => $row['email'],
					'password' => $row['password'],
					'titulo' => $row['idTitulo'], #titulo
          'user' => $row['user'],
          'fechaIn' => $row['fechaIn'],
          'experienciaEmpresa' => $row['experiencia'],
          'tituloEstudio' => $row['tituloEstudio'],
          'enfoqueEstudios' => $row['enfoqueEstudios'],
          'rol' => $row['rol'],
          'foto' => $row['foto'],
          'estado' => $row['estado'],
				];
				array_push($data, $item);
			};

			while ($row = $expSoftware->fetch()){
				$item = [
					'idExpSoftware' => $row['idExpSoftware'],
					'cargo' => $row['cargo'],
					'testing' => $row['testing'],
					'requerimientos' => $row['requerimientos'],
					'experiencia' => $row['experiencia'],
					'calidad' => $row['calidad'],
					'gestionCalidad' => $row['gestionCalidad'], #titulo
					'empresa' => $row['empresa'],
					'gestionConfig' => $row['gestionConfig'],
					'ut' => $row['ut'],
					'design' => $row['design'],
					'cedulaUsuario' => $row['cedulaUsuario'],
					'idHambito' => $row['idhambito'],
				];
				array_push($data, $item);
			};

			while ($row = $expPorcentual->fetch()){
				$item = [
					'idExpPorcentual' => $row['idExpPorcentual'],
					'empresa' => $row['empresa'],
					'calidad' => $row['calidad'],
					'requerimientos' => $row['requerimientos'],
					'cargo' => $row['cargo'],
					'gestionConfig' => $row['gestionConfig'],
					'gestionCalidad' => $row['gestionCalidad'],
					'cedulaUsuario' => $row['cedulaUsuario']
				];
				array_push($data, $item);
			};

			while ($row = $expProgramando->fetch()){
				$item = [
					'idExpProgramando' => $row['idExpProgramando'],
					'lenguajes' => $row['lenguajes'],
					'lenguajeLDC' => $row['lenguajeLDC'],
					'lenguajesLDC' => $row['lenguajesLDC'],
					'cedulaUsuario' => $row['cedulaUsuario'],
					'idLenguaje' => $row['idLenguaje']
				];
				array_push($data, $item);
			};

			return $data;

		}

		function validar($campo, $valor){
			$query = $this->db->connect()->query("SELECT * FROM usuarios WHERE $campo = '$valor'");
			$data = [];
			while ($row = $query->fetch()){
				$item = [
					'cedula' => $row['cedulaUsuario'],
					'email' => $row['email'],
          'user' => $row['user'],
          'rol' => $row['rol'],
				];
				array_push($data, $item);
			};
			return $data;
		}

		function getListado($condicion = "nada"){
			$data = [];

			if($condicion == "nada"){
				$query = $this->db->connect()->query("SELECT * FROM usuarios");
				while ($row = $query->fetch()){
						$item = [
								'cedula' => $row['cedulaUsuario'],
								'nombre' => $row['nombre'],
								'apellido' => $row['apellido'],
								'email' => $row['email'],
								'user' => $row['user'],
								'empresa' => $row['empresa'],
								'experiencia' => $row['experiencia'],
								'estado' =>  $row['estado'], #$row['proyecto']
								'foto' => $row['foto'],
								'titulo' => $row['idTitulo']
						];
						array_push($data, $item);
				}
			}else{
				$query = $this->db->connect()->query("SELECT * FROM usuarios WHERE estado = $condicion");
				while ($row = $query->fetch()){
						$item = [
								'cedula' => $row['cedulaUsuario'],
								'nombre' => $row['nombre'],
								'apellido' => $row['apellido'],
								'email' => $row['email'],
								'user' => $row['user'],
								'empresa' => $row['empresa'],
								'experiencia' => $row['experiencia'],
								'estado' =>  $row['estado'], #$row['proyecto']
								'foto' => $row['foto'],
								'titulo' => $row['idTitulo']
						];
						array_push($data, $item);
				}
			}

			return $data;
		}

		function nuevo($data){
			$query = $this->db->connect()->prepare("INSERT INTO usuarios(cedulaUsuario, nombre,apellido,email,user,password,rol,foto,estado)VALUES(:cedula, :nombre, :apellido, :email, :user, :password, :rol, :foto, :estado)");
			$query->execute([
				'cedula' => $data['cedula'],
				'nombre' => $data['nombre'],
				'apellido' => $data['apellido'],
				'email' => $data['email'],
				'user' => $data['user'],
				'password' => password_hash($data['password'], PASSWORD_DEFAULT, ['cost' => 10]) ,
				'rol' => 'programador',
				'foto' => 'public/img/usuarios/user-default.png',
				'estado' => 'false'
			]);

			$expporcentual = $this->db->connect()->prepare("INSERT INTO expporcentual(idExpPorcentual, cedulaUsuario) VALUES(:id, :cedula)");
			$expporcentual->execute([
				'id' => getdate()[0],
				'cedula' => $data['cedula']
			]);

			$expprogramando = $this->db->connect()->prepare("INSERT INTO expprogramando(idExpProgramando, cedulaUsuario) VALUES(:id, :cedula)");
			$expprogramando->execute([
				'id' => getdate()[0],
				'cedula' => $data['cedula']
			]);

			$expsoftware = $this->db->connect()->prepare("INSERT INTO expsoftware(idExpSoftware, cedulaUsuario) VALUES(:id, :cedula)");
			$expsoftware->execute([
				'id' => getdate()[0],
				'cedula' => $data['cedula']
			]);

		}

		function insert($data){
			#cuando el admin inserta manualmente el programador
		}

		function update($data){
			if($data['foto'] != -1){
				$queryUsuarios = $this->db->connect()->prepare("UPDATE usuarios SET foto = :foto, nombre = :nombre, apellido = :apellido, empresa = :empresa, email = :email, idTitulo = :idTitulo, experiencia = :experiencia, tituloEstudio = :tituloEstudio, enfoqueEstudios = :enfoqueEstudios WHERE cedulaUsuario = :cedula");

				$queryUsuarios->execute([
					'foto' => $data['foto'],
					'cedula' => $data['cedula'],
					'nombre' => $data['nombre'],
					'apellido' => $data['apellido'],
					'empresa' => $data['empresaNombre'],
					'email' => $data['email'],
					'idTitulo' => $data['tituloDesarrollo'],
					'experiencia' => $data['experienciaEmpresa'],
					'tituloEstudio' => $data['tituloProfesional'],
					'enfoqueEstudios' => $data['enfoque']
					// 'estado' => $data['estado'],
				]);


			}else{
				$queryUsuarios = $this->db->connect()->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, empresa = :empresa, email = :email, idTitulo = :idTitulo, experiencia = :experiencia, tituloEstudio = :tituloEstudio, enfoqueEstudios = :enfoqueEstudios WHERE cedulaUsuario = :cedula");
				$queryUsuarios->execute([
					'cedula' => $data['cedula'],
					'nombre' => $data['nombre'],
					'apellido' => $data['apellido'],
					'empresa' => $data['empresaNombre'],
					'email' => $data['email'],
					'idTitulo' => $data['tituloDesarrollo'],
					'experiencia' => $data['experienciaEmpresa'],
					'tituloEstudio' => $data['tituloProfesional'],
					'enfoqueEstudios' => $data['enfoque']
				]);
			}

			$queryExpSoftware = $this->db->connect()->prepare("UPDATE expsoftware SET cargo = :cargo, testing = :testing, requerimientos = :requerimientos, experiencia = :experiencia, calidad = :calidad, gestionCalidad = :gestionCalidad, empresa = :empresa, gestionConfig = :gestionConfig, ut = :ut, design = :design, idHambito = :idHambito WHERE cedulaUsuario = :cedula and idExpSoftware =  :idExpSoftware");

			$queryExpSoftware->execute([
				'idExpSoftware' => $data['idExpSoftware'],
				'cargo' => $data['cargo'],
				'testing' => $data['testing'],
				'requerimientos' => $data['requerimientos'],
				'experiencia' => $data['experiencia'],
				'calidad' => $data['calidad'],
				'gestionCalidad' => $data['gestionCalidad'] ,
				'empresa' => $data['empresa'],
				'gestionConfig' => $data['gestionConfig'],
				'ut' => $data['ut'],
				'design' => $data['design'],
				'idHambito' => $data['idHambito'],
				'cedula' => $data['cedula']
			]);

			$queryExpPorcentual = $this->db->connect()->prepare("UPDATE expporcentual SET empresa = :pempresa, calidad = :pcalidad, requerimientos = :prequerimientos, cargo = :pcargo, gestionConfig = :pgestionConfig, gestionCalidad = :pgestionCalidad WHERE cedulaUsuario = :cedula and idExpPorcentual =  :pidExpPorcentual");

			$queryExpPorcentual->execute([
				'cedula' => $data['cedula'],
				'pidExpPorcentual' => $data['pidExpPorcentual'],
				'pempresa' => $data['pempresa'],
				'pcalidad' => $data['pcalidad'],
				'prequerimientos' => $data['prequerimientos'],
				'pcargo' => $data['pcargo'],
				'pgestionConfig' => $data['pgestionConfig'],
				'pgestionCalidad' => $data['pgestionCalidad'],
			]);

			$queryExpProgramando = $this->db->connect()->prepare("UPDATE expprogramando SET lenguajes = :listLenguajes, lenguajeLDC = :lenguajeLDC, idLenguaje = :lenguaje, lenguajesLDC = :lenguajesLDC WHERE cedulaUsuario = :cedula and idExpProgramando =  :idExpProgramando");

			$queryExpProgramando->execute([
				'cedula' => $data['cedula'],
				'idExpProgramando' => $data['idExpProgramando'],
				'listLenguajes' => $data['listLenguajes'],
				'lenguajeLDC' => $data['lenguajeLDC'],
				'lenguajesLDC' => $data['lenguajesLDC'],
				'lenguaje' => $data['lenguaje'],
			]);

		}

		function getPassword($cedula, $password){
      $query = $this->db->connect()->prepare("UPDATE usuarios SET password = :password WHERE cedulaUsuario = :cedula ");
      $query->execute([
        'cedula' => $cedula,
        'password' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]) ,
      ]);
    }

		function aspirante($cedula){
			$query = $this->db->connect()->query("UPDATE usuarios SET estado = 1 WHERE cedulaUsuario = $cedula[0] ");
		}

		function rechazados($cedula){
			$query = $this->db->connect()->query("UPDATE usuarios SET estado = 3 WHERE cedulaUsuario = $cedula[0] ");
		}
	}

?>
