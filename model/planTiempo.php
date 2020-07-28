<?php

  Class PlanTiempo extends Model{
    function __construct(){
      parent::__construct();
    }

    function insert($data){
      $query = $this->db->connect()->prepare('INSERT INTO planTiempo(idTiempo, planeacion, design, designRevisado, codigo, codigoRevisado,  compilacion, pruebasUnitarias, postMortem, idProyectoUsuario) VALUES (:id, :planeacion,:design, :designRevisado, :codigo, :codigoRevisado, :compilacion, :ut, :pm, :idpu)');
      $query->execute([
        'id' => $data['id'],
        'planeacion' => $data['planeacion'],
        'design' => $data['design'],
        'designRevisado' => $data['designRevisado'],
        'codigo' => $data['codigo'],
        'codigoRevisado' => $data['codigoRevisado'],
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
