<?php
  Class reportesModel extends Model{
    function __construct(){
      parent::__construct();
    }

    function getData(){
      $programadores  = $this->getPersonas();
      $fullData = [];
      foreach ($programadores  as $value) {
        $data = [
          'cedulaUsuario' => $value['cedulaUsuario'],
          'nombre' => $value['nombre'],
          'apellido' => $value['apellido'],
          'fechaIn' => $value['fechaIn'],
          'proyectos' => $this->getProyecto($value['cedulaUsuario']),
        ];
        array_push($fullData, $data);
      }
      return $fullData;
    }


    function getPersonas(){
      $query = $this->db->connect()->query('select * from usuarios where estado = 1');
      $data = [];
      while ($row = $query->fetch()) {
        $item = [
          'cedulaUsuario' => $row['cedulaUsuario'],
          'nombre' => $row['nombre'],
          'apellido' => $row['apellido'],
          'fechaIn' => $row['fechaIn'],
        ];
        array_push($data, $item);
      }
      return $data;
    }

    function getProyecto($cedula){
      $dataProyectos = $this->getPivote($cedula);
      $proyectos = [];

      $totalTiempos = [
        'fase01' => 0,
        'fase02' => 0,
        'fase03' => 0,
        'fase04' => 0,
        'fase05' => 0,
        'fase06' => 0,
        'fase07' => 0,
        'fase08' => 0,
        'tiempoTrabajado' => 0,
        'tiempoMuerto' => 0,
        'tiempoTotal' => 0,
        'interrupciones' => 0,
      ];



      foreach ($dataProyectos as $row) {
        $idpu = $row['idProyectoUsuario'];
        $query = $this->db->connect()->query("select * from tiempos where idProyectoUsuario = $idpu");

        while ($rowTiempo = $query->fetch()) {
          $totalTiempos[$rowTiempo['idFase']] += round($rowTiempo['totalTiempo'] /60 ,2);
          $totalTiempos['tiempoTrabajado'] += round($rowTiempo['totalTiempo']/60,2);
          $totalTiempos['tiempoMuerto'] += round($rowTiempo['tiempoMuerto']/60,2);
          $totalTiempos['interrupciones'] += $rowTiempo['interrupciones'];
        }
        $totalTiempos['tiempoTotal'] += ($totalTiempos['tiempoTrabajado'] + $totalTiempos['tiempoMuerto']);
        $proyectos['totalTiempo'] = $totalTiempos;
      }
      $defectosDC = [
        'desing' => 0,
        'codigo' => 0,
      ];

      $defectosFase = [
        'fase01' => 0,
        'fase02' => 0,
        'fase03' => 0,
        'fase04' => 0,
        'fase05' => 0,
        'fase06' => 0,
        'fase07' => 0,
        'fase08' => 0,
      ];

      $sizeProject = [
        'plan' => 0,
        'actual' => 0,
      ];
      foreach ($dataProyectos as $row) {
        $idpu = $row['idProyectoUsuario'];
        $query = $this->db->connect()->query("select * from deteccionerrores where idProyectoUsuario = $idpu");
        while ($row = $query->fetch()) {
          $defectosFase[$row['faseCreacionError']] += 1;
          if($row['faseCreacionError'] == 'fase02'){
            $defectosDC['desing'] += 1;
          }else if($row['faseCreacionError'] == 'fase04'){
            $defectosDC['codigo'] += 1;
          }

        }
        $proyectos['defectosDC'] = $defectosDC;
      }

      $defectosRemovidos = [
        'revisionDesign' => 0,
        'revicionCodigo' => 0,
        'compilacion' => 0,
        'pu' => 0,
      ];

      foreach ($dataProyectos as $row) {
        $idpu = $row['idProyectoUsuario'];
        $query = $this->db->connect()->query("select * from deteccionerrores where idProyectoUsuario = $idpu");

        while ($row = $query->fetch()) {
          if($row['faseEliminacionError'] == 'fase03'){
            $defectosRemovidos['revisionDesign'] += 1;
          }else if($row['faseEliminacionError'] == 'fase05'){
            $defectosRemovidos['revicionCodigo'] += 1;
          }else if($row['faseEliminacionError'] == 'fase06'){
            $defectosRemovidos['compilacion'] += 1;
          }else if($row['faseEliminacionError'] == 'fase07'){
            $defectosRemovidos['pu'] += 1;
          }
        }
        $proyectos['defectosRemovidos'] = $defectosRemovidos;
      }

      return $proyectos;
    }

    function getPivote($cedula){
      $query = $this->db->connect()->query("select * from proyectosusuarios where cedulaUsuario = $cedula");
      $data = [];
      while ($row = $query->fetch()) {
        $item = [
          'idProyectoUsuario' => $row['idProyectoUsuario'],
          'idProyecto' => $row['idProyecto'],
        ];

        array_push($data, $item);
      }

      return $data;
    }
  }
?>
