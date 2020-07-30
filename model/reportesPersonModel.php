<?php

  Class ReportesPersonModel extends Model{
    function __construct(){
      parent::__construct();
    }


    function getData($cedula){
      $query = $this->db->connect()->query("SELECT * FROM usuarios WHERE cedulaUsuario = $cedula");
      $row = $query->fetch();

      if($row == false){
        return false;
      }

      $fullData = [
        'cedulaUsuario' => $row['cedulaUsuario'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'fechaIn' => $row['fechaIn'],
        'proyecto' => $this->fullProyect($cedula),
      ];
      echo "<pre>";
      var_dump($fullData);
      return $fullData;
    }



    function fullProyect($cedula){
      $idpu = $this->getPivote($cedula);
      return $idpu;
    }


    function getPivote($cedula){
      $query = $this->db->connect()->query("select * from proyectosusuarios where cedulaUsuario = $cedula");
      $data = [];
      while ($row = $query->fetch()) {
        array_push($data, $row['idProyectoUsuario']);
      }

      return $data;
    }
  }
?>
