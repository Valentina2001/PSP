<?php

  Class ReporteModel extends Model{
    function __construct(){
      parent::__construct();
    }

    function listado($id){
      $query = $this->db->connect()->query("select * from reportes where idProyectoUsuario = $id");
      $data = [];
      while($row = $query->fetch()){
        $item = [
          'idReporte' => $row['idReporte'],
          'fecha' => $row['fecha'],
          'nombre' => $row['nombre'],
          'objetivo' => $row['objetivo'],
          'condiciones' => $row['condiciones'],
          'resEsperado' => $row['resEsperado'],
          'resActual' => $row['resActual'],
          'descripcion' => $row['descripcion'],
        ];
        array_push($data, $item);
      }

      return $data;

    }

    function insert($data){
      $query = $this->db->connect()->prepare('insert into reportes(idReporte, nombre, objetivo, condiciones, resEsperado, resActual, descripcion, idProyectoUsuario) values (:idReporte, :nombre, :objetivo, :condiciones, :resEsperada, :resActual, :descripcion, :idProyectoUsuario)');

      $query->execute([
        'idReporte' => $data['id'],
        'nombre' => $data['nombre'],
        'objetivo' => $data['objetivo'],
        'condiciones' => $data['condiciones'],
        'resEsperada' => $data['esperado'],
        'resActual' => $data['actual'],
        'descripcion' => $data['descripcion'],
        'idProyectoUsuario' => $data['idpu'],
      ]);
    }

    function eliminar($id){
      $query = $this->db->connect()->query("delete from reportes where idReporte = $id");
    }

    function actualizar($data){
      $query = $this->db->connect()->prepare('update reportes set nombre = :nombre, objetivo = :objetivo, condiciones = :condiciones, resEsperado = :resEsperado, resActual = :resActual, descripcion = :descripcion where idReporte = :id');
      $query->execute([
        'nombre' => $data['nombre'],
        'objetivo' => $data['objetivo'],
        'condiciones' => $data['condiciones'],
        'resEsperado' => $data['esperado'],
        'resActual' => $data['actual'],
        'descripcion' => $data['descripcion'],
        'id' => $data['id'],
      ]);
    }


  }

?>
