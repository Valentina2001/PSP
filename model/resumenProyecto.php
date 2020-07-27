<?php

  Class ResumenProyecto extends Model{
    function __construct(){
      parent::__construct();

    }

    function get($id){
      $query = $this->db->connect()->query("select * from planResumenProyecto where idProyectoUsuario = $id");
      $row = $query->fetch();
      $item = [
        'plan' => (empty($row['plan'])) ? '' : $row['plan'],
        'actual' => (empty($row['actual'])) ? '' : $row['actual'],
        'idResumenProyecto' => (empty($row['idResumenProyecto'])) ? '' : $row['idResumenProyecto'],
      ];
      return $item;
    }


    function insert($data){
      $query = $this->db->connect()->prepare('insert into planResumenProyecto(idResumenProyecto, plan, actual, idProyectoUsuario) values (:id, :plan, :actual, :idpu)');

      $query->execute([
        'id' => getdate()[0],
        'plan' => $data['plan'],
        'actual' => $data['actual'],
        'idpu' => $data['idpu'],
      ]);
    }

    function actualizar($data){
      $query = $this->db->connect()->prepare('update planResumenProyecto set plan = :plan, actual = :actual where idResumenProyecto = :id ');
      $query->execute([
        'id' => $data['id'],
        'plan' => $data['plan'],
        'actual' => $data['actual'],
      ]);
    }
  }
?>
