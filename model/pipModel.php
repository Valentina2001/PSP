<?php
  Class PipModel extends Model{
    function __construct(){
      parent::__construct();
    }


    function listado($id){
      $query = $this->db->connect()->query("SELECT * from pip where idProyectoUsuario = $id");

      $data = [];

      while($row = $query->fetch()){
        $item = [
          'idPip' => $row['idPip'],
          'fecha' => $row['fecha'],
          'descripcion' => $row['descripcion'],
          'solucion' => $row['solucion'],
          'comentarios' => $row['comentarios'],
        ];

        array_push($data, $item);
      }
      return $data;
    }

    function insert($data){
      $query = $this->db->connect()->prepare('INSERT INTO pip(idPip, descripcion, solucion, comentarios, idProyectoUsuario) VALUES(:id, :descripcion, :solucion, :comentarios, :idProyectoUsuario)');
      $query->execute([
        'id' => $data['idPip'],
        'descripcion' => $data['problema'],
        'solucion' => $data['propuesta'],
        'comentarios' => $data['comentarios'],
        'idProyectoUsuario' => $data['idpu'],
      ]);
    }

    function set($data){
      $query = $this->db->connect()->prepare("UPDATE pip set descripcion = :descripcion, solucion = :solucion, comentarios = :comentarios where idPip = :id ");
      $query->execute([
        'id' => $data['idPip'],
        'descripcion' => $data['problema'],
        'solucion' => $data['propuesta'],
        'comentarios' => $data['comentarios'],
      ]);
    }

    function eliminar($id){
      $this->db->connect()->query("DELETE FROM pip WHERE idPip = $id");
    }

  }

?>
