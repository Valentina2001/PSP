<?php
  Class TitulosModel extends Model{
    function __construct(){
      parent::__construct();
    }

    function getListado(){
      $resultData = $this->db->connect()->query("SELECT * FROM titulos");
      $data = [];
      while ($row = $resultData->fetch()){
        $item = [
          'idTitulo' => $row['idTitulo'],
          'nombre' => $row['nombre']
        ];
        array_push($data, $item);
      }
      return $data;
    }
  }
?>
