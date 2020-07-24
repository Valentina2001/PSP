<?php
  Class ErroresProyectoModel extends Model{
    function __construct(){
      parent::__construct();
    }
    function getListadoErrores($idpu){
      $query = $this->db->connect()->query("SELECT * from deteccionerrores where idProyectoUsuario = $idpu");
      $data = [];

      while ($row = $query->fetch()){
        $item = [
          'id' => $row['idDeteccionError'],
          'fechaIn' => $row['fechaIn'],
          'horaIn' => $row['horaIn'],
          'fechaOut' => $row['fechaOut'],
          'horaOut' => $row['horaOut'],
          'descripcionError' => $row['descripcion'],
          'descripcionSolucion' => $row['descripcionSolucion'],
          'faseIn' => $row['faseCreacionError'],
          'faseOut' => $row['faseEliminacionError'],
          'tiempoSolucionar' => $row['tiempoSolucionar'],
          'reparacionLDC' => $row['reparacionLDC'],
          'idErrorTipo' => $row['idErrorTipo'],
          'idProyectoUsuario' => $row['idProyectoUsuario'],
          'idFase' => $row['idFase'],
        ];

        array_push($data, $item);
      }

      return $data;
    }


    function erroresEstandar(){
      $query = $this->db->connect()->query("select * from errorTipos");

      $data = [];

      while ($row =  $query->fetch()) {
        $item = [
          'id' => $row['idErrorTipo'],
          'codigo' => $row['codigo'],
          'nombre' => $row['nombre'],
          'descripcion' => $row['descripcion'],
        ];
        array_push($data, $item);
      }

      return $data;
    }

    function insertError($data){
      $query = $this->db->connect()->prepare("INSERT INTO deteccionerrores(idDeteccionError, fechaIn, horaIn, fechaOut, horaOut, descripcion, faseCreacionError, descripcionSolucion, faseEliminacionError, tiempoSolucionar, reparacionLDC, idErrorTipo, idProyectoUsuario, idFase) values (:id, :fechaIn, :horaIn, :fechaOut, :horaOut, :comentarioError, :faseIn, :solucionError, :faseOut, :tiempoTotal, :ldc, :tipoError, :idpu, :idFase )");

      $query->execute([
        'id' => $data['id'],
        'tiempoTotal' => $data['tiempoTotal'],
        'faseIn' => $data['faseIn'],
        'faseOut' => $data['faseOut'],
        'tipoError' => $data['tipoError'],
        'fechaIn' => $data['fechaIn'],
        'horaIn' => $data['horaIn'],
        'fechaOut' => $data['fechaOut'],
        'horaOut' => $data['horaOut'],
        'comentarioError' => $data['comentarioError'],
        'solucionError' => $data['solucionError'],
        'ldc' => $data['ldc'],
        'idpu' => $data['idpu'],
        'idFase' => $data['faseIn'],
      ]);
    }

    function actualizar($data){
      $query = $this->db->connect()->prepare("UPDATE deteccionerrores SET descripcion = :descripcionError, descripcionSolucion = :descripcionSolucion WHERE idDeteccionError = :id ");

      $query->execute([
        'descripcionError' => $data['descripcionError'],
        'descripcionSolucion' => $data['descripcionSolucion'],
        'id' => $data['id'],
      ]);
    }

    function tipoErrores(){
      $query = $this->db->connect()->query("select * from errortipos");

      $data = [];

      while ($row = $query->fetch()) {
        $item = [
          'codigo' => $row['codigo'],
          'nombre' => $row['nombre'],
          'descripcion' => $row['descripcion'],
        ];

        array_push($data, $item);
      }

      return $data;
    }

  }

?>
