<?php
  Class ProyectosModel extends Model{
    function __construct(){
      parent::__construct();
    }

    function getListado(){
      $query = $this->db->connect()->query('SELECT * FROM proyectos');
      $data = [];
      while ($row = $query->fetch()) {
        $item  = [
          'idProyecto' => $row['idProyecto'],
          'nombre' => $row['nombre'],
          'descripcion' => $row['descripcion'],
          'idMedida' => $row['idMedida'],
          'idProceso' => $row['idProceso'],
          'fechaIn' => $row['fechaIn'],
          'fechaOut' => $row['fechaOut'],
          'idLenguaje' => $row['idLenguaje'],
          'cedulaAdministrador' => $row['cedulaAdministrador'],

        ];
        array_push($data, $item);
      }
      return $data;
    }

    function get($id){
      $query = $this->db->connect()->prepare("SELECT * FROM proyectos WHERE idProyecto = :id");
      $query->execute([
        'id' => $id[0]
      ]);
      $row = $query->fetch();
      $item  = [
        'idProyecto' => (isset($row['idProyecto'])) ? $row['idProyecto'] : "",
        'nombre' => (isset($row['nombre'])) ? $row['nombre'] : "",
        'descripcion' => (isset($row['descripcion'])) ? $row['descripcion'] : "",
        'idMedida' => (isset($row['idMedida'])) ? $row['idMedida'] : "",
        'idProceso' => (isset($row['idProceso'])) ? $row['idProceso'] : "",
        'fechaIn' => (isset($row['fechaIn'])) ? $row['fechaIn'] : "",
        'fechaOut' => (isset($row['fechaOut'])) ? $row['fechaOut'] : "",
        'idLenguaje' => (isset($row['idLenguaje'])) ? $row['idLenguaje'] : "",
        'cedulaAdministrador' => (isset($row['cedulaAdministrador'])) ? $row['cedulaAdministrador'] : "",
      ];

      return $item;
    }

    function setProyecto($data){
      $query = $this->db->connect()->prepare("UPDATE proyectos SET nombre = :nombre, descripcion = :descripcion, idMedida = :idMedida, idProceso = :idProceso, fechaOut = :fechaOut, idLenguaje = :idLenguaje WHERE cedulaAdministrador = :cedula AND idProyecto = :idProyecto");

      $query->execute([
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
        'idMedida' => $data['idMedida'],
        'idProceso' => $data['idProceso'],
        'cedula' => $data['cedulaAdministrador'],
        'fechaOut' => $data['fechaOut'],
        'idProyecto' => $data['idProyecto'],
        'idLenguaje' => $data['idLenguaje'],


      ]);
    }

    function crear($data){
      $query = $this->db->connect()->prepare("INSERT INTO proyectos(idProyecto, nombre, descripcion, idMedida , idProceso , fechaIn , fechaOut, cedulaAdministrador, idLenguaje) VALUES (:idProyecto, :nombre, :descripcion, :idMedida, :idProceso, :fechaIn, :fechaOut, :cedula, :idLenguaje)");
      $query->execute([
        'idProyecto' => $data['idProyecto'],
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
        'idMedida' => $data['idMedida'],
        'idProceso' => $data['idProceso'],
        'fechaIn' => $data['fechaIn'],
        'fechaOut' => $data['fechaOut'],
        'idLenguaje' => $data['idLenguaje'],
        'cedula' => $data['cedulaAdministrador'],
      ]);
    }

    function getProgramadores($codigo){
      $query = $this->db->connect()->query("select * from proyectos as pro inner join proyectosusuarios as pu on pro.idProyecto = pu.idProyecto where pro.idProyecto = $codigo");

      $data = [];

      while ($row = $query->fetch()) {
        $item = [
          'idProyecto' => $row['idProyecto'],
          'nombre' => $row['nombre'],
          'descripcion' => $row['descripcion'],
          'idMedida' => $row['idMedida'],
          'idProceso' => $row['idProceso'],
          'fechaIn' => $row['fechaIn'],
          'fechaOut' => $row['fechaOut'],
          'cedulaAdministrador' => $row['cedulaAdministrador'],
          'cedulaUsuario' => $row['cedulaUsuario'],
        ];

        array_push($data, $item);
      }

      return $data;
    }


    function eliminar($codigo){
      $this->db->connect()->query("DELETE FROM proyectos WHERE idProyecto = $codigo");
    }

    function NoAsociados($codigo){
      $query = $this->db->connect()->query("select count(*) from proyectosusuarios where idProyecto = $codigo");

      return $query->fetch();

    }

  }

?>
