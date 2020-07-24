<?php
  Class tiempoModel extends Model{
    function __construct(){
      parent::__construct();
    }

    function insert($data){

      $query = $this->db->connect()->prepare("INSERT INTO tiempos(idTiempo, fechaInicio, horaInicio, fechaFin, horaFin, interrupciones, totalTiempo, comentarios, idFase, tiempoMuerto, idProyectoUsuario) values(:idTiempo, :fechaInicio, :horaInicio, :fechaFin, :horaFin, :interrupciones, :totalTiempo, :comentarios, :idFase, :tiempoMuerto, :idProyectoUsuario)");
      $query->execute([
        'idTiempo' => $data['idTiempo'],
        'fechaInicio' => $data['fechaIn'],
        'horaInicio' => $data['horaIn'],
        'fechaFin' => $data['fechaOut'],
        'horaFin' => $data['horaOut'],
        'interrupciones' => $data['interrupciones'],
        'totalTiempo' => $data['tiempoTotal'],
        'comentarios' => $data['comentarios'],
        'idFase' => $data['fase'],
        'tiempoMuerto' => $data['tiempoMuerto'],
        'idProyectoUsuario' => $data['idProyectoUsuario'],
      ]);
    }


    function getListado($id){
      $query = $this->db->connect()->query("select * from tiempos where idProyectoUsuario = $id");
      $data = [];

      while ($row = $query->fetch()) {
        $item = [
          'fechaIn' => $row['fechaInicio'],
          'horaIn' => $row['horaInicio'],
          'fechaOut' => $row['fechaFin'],
          'horaOut' => $row['horaFin'],
          'interrupciones' => $row['interrupciones'],
          'tiempoTotal' => round(($row['totalTiempo'] / 60), 2),
          'comentarios' => $row['comentarios'],
          'idFase' => $row['idFase'],
          'tiempoMuerto' => round(($row['tiempoMuerto'] / 60), 2),
          'idProyectoUsuario' => $row['idProyectoUsuario'],
        ];
        array_push($data, $item);
      }
      return  $data;
    }


    function sumatoria($id, $fase){
      $query = $this->db->connect()->prepare("SELECT SUM(totalTiempo) AS suma from tiempos where idProyectoUsuario = :id and idFase = :fase");
      $query->execute([
        'id' => $id,
        'fase' => $fase
      ]);
      $numero = round(($query->fetch()['suma'] / 60 ),2);
      return ($numero == 0) ? '0.00' : $numero;
    }
  }
?>
