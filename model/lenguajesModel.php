<?php
	class lenguajesModel extends Model{
		function __construct(){
			parent::__construct();
		}

    function getListado(){
      $query = $this->db->connect()->query("SELECT * FROM lenguajes");

      $data = [];

      while ($row = $query->fetch()){
          $item = [
              'idLenguaje' => $row['idLenguaje'],
              'nombre' => $row['nombre']
          ];
          array_push($data, $item);
      }
      return $data;
    }

		function getLenguaje($nombre){
			$query = $this->db->connect()->query("SELECT * FROM lenguajes WHERE nombre = '$nombre'");
			$row = $query->fetch();
			if($row){
				return $row['idLenguaje'];
			}
			return null;
		}

		function nuevo($data){
			$query = $this->db->connect()->prepare("INSERT INTO lenguajes(idLenguaje, nombre) values(:idLenguaje, :nombre)");
			$query->execute([
				'idLenguaje' => $data['idLenguaje'],
				'nombre' => $data['nombre']
			]);
		}

		function setLenguaje($data){
			$query = $this->db->connect()->prepare("UPDATE lenguajes SET nombre = :nombre WHERE idLenguaje = :idLenguaje");
			$query->execute([
				'idLenguaje' => $data['idLenguaje'],
				'nombre' => $data['nombre']
			]);
		}

		function eliminar($id){
			$this->db->connect()->query("DELETE FROM lenguajes WHERE idLenguaje = '$id'");
		}

	}

?>
