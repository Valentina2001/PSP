<?php

  Class PlanDefectos extends Model{
    function __construct(){
      parent::__construct();
    }

    function insertInyectados($data){
      $query = $this->db->connect()->prepare('INSERT INTO planDefectosinyectados(idDefectosInyectados, planeacion, design, codigo, compilacion, pruebasUnitarias, postMortem, idProyectoUsuario) VALUES (:id, :planeacion,:design, :codigo, :compilacion, :ut, :pm, :idpu)');
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

    function insertRemovidos($data){
      $query = $this->db->connect()->prepare('INSERT INTO planDefectosremovidos(idDefectosRemovidos, planeacion, design, codigo, compilacion, pruebasUnitarias, postMortem, idProyectoUsuario) VALUES (:id, :planeacion,:design, :codigo, :compilacion, :ut, :pm, :idpu)');
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
    function getInyectados($id){
      $query = $this->db->connect()->query("SELECT * from planDefectosinyectados where idProyectoUsuario = $id");
      return $query->fetch();

    }
    function getRemovidos($id){
      $query = $this->db->connect()->query("SELECT * from planDefectosremovidos where idProyectoUsuario = $id");
      return $query->fetch();

    }

  }


?>
