<?php
  Class ProcesosModel extends Model{
    function __construct(){
      parent::__construct();
    }

    function getListado(){
      $query = $this->db->connect()->query('SELECT * FROM procesos');
      $data = [];
      while($row = $query->fetch()){
        $item = [
          'idProceso' => $row['idProceso'],
          'acronimo' => $row['acronimo'],
          'nombre' => $row['nombre'],
        ];
        array_push($data, $item);
      }
      return $data;
    }
  }

?>
