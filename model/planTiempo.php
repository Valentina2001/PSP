<?php

  Class PlanTiempo extends Model{
    function __construct(){
      parent::__construct();
    }

    function insert($data){
      $query = $this->db->connect()->prepare('INSERT INTO planTiempo(idTiempo, planeacion, design, codigo, compilacion, pruebasUnitarias, postMortem, idProyectoUsuario) VALUES (:id, :planeacion,:design, :codigo, :compilacion, :ut, :pm, :idpu)');
      $query->execute([
        'id' => $data['id'],
        'planeacion' => $data['planeacion'],
        'design' => $data['design'],
        'codigo' => $data['codigo'],
        'compilacion' => $data['compilar'],
        'ut' => $data['ut'],
        'pm' => $data['pm'],
        'idpu' => $data['idpu'],
      ]);
    }

    function get($id){
      $query = $this->db->connect()->query("SELECT * from planTiempo where idProyectoUsuario = $id");
      return $query->fetch();

    }

  }


?>
