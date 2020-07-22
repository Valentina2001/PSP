<?php
  Class MedidasModel extends Model{
    function __construct(){
      parent::__construct();
    }


    function getListado(){
      $query = $this->db->connect()->query('SELECT * FROM medidas');
      $data = [];
      while($row = $query->fetch()){
        $item = [
          'idMedida' => $row['idMedida'],
          'acronimo' => $row['acronimo'],
          'nombre' => $row['nombre'],
          'descripcion' => $row['descripcion'],
        ];

        array_push($data, $item);
      }
      return $data;
    }
  }
?>
