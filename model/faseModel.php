<?php
  Class faseModel extends Model{
    function __construct(){
      parent::__construct();
    }

    function getListado(){
      $resultData = $this->db->connect()->query("SELECT * FROM fases");
      $data = [];
      while ($row = $resultData->fetch()){
        $item = [
          'idFase' => $row['idFase'],
          'nombre' => $row['nombre'],
          'descripcion' => $row['descripcion']
        ];
        array_push($data, $item);
      }
      return $data;
    }
  }
?>
