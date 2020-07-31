<?php

  Class ReportesPersonModel extends Model{
    function __construct(){
      parent::__construct();
    }


    function getData($cedula){
      $query = $this->db->connect()->query("SELECT * FROM usuarios WHERE cedulaUsuario = $cedula");
      $row = $query->fetch();

      if($row == false){
        return false;
      }

      $fullData = [
        'cedulaUsuario' => $row['cedulaUsuario'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'fechaIn' => $row['fechaIn'],
        'proyecto' => $this->fullProyect($cedula),
      ];
      // echo "<pre>";
      // var_dump($fullData);
      return $fullData;
    }

    function fullProyect($cedula){
      $dataPivote = $this->getPivote($cedula);
       $data = [];
       $procesos = [
         'psp0' => 0,
         'psp01' => 0,
         'psp1' => 0,
         'psp11' => 0,
         'psp20' => 0,
         'psp21' => 0,
       ];

      $tiempoPorc = [
         'fase01' => 0,
         'fase06' => 0,
         'fase07' => 0,
         'fase08' => 0,
       ];

       $tiempoPlaneacion = [
         'fase01' => 0,
         'fase08' => 0,
       ];

       $defectosInyectados = [
         'fase02' => 0,
         'fase04' => 0,
       ];

       $resumenProyecto = 0;

       $defectosRemovidos = [
         'fase03' => 0,
         'fase04' => 0,
         'fase06' => 0,
         'fase07' => 0,
       ];

      $defectosTipo = [
        'error01' => 0,
        'error02' => 0,
        'error03' => 0,
        'error04' => 0,
        'error05' => 0,
        'error06' => 0,
        'error07' => 0,
        'error08' => 0,
        'error09' => 0,
        'error10' => 0,
      ];
      $defectosTiempo = [
        'error01' => 0,
        'error02' => 0,
        'error03' => 0,
        'error04' => 0,
        'error05' => 0,
        'error06' => 0,
        'error07' => 0,
        'error08' => 0,
        'error09' => 0,
        'error10' => 0,
      ];

       foreach ($dataPivote as $pivoteRow) {
         $idpu = $pivoteRow['idpu'];
         $query = $this->db->connect()->query("select * from proyectos as pro inner join proyectosusuarios as pu on pro.idProyecto = pu.idProyecto inner join tiempos as tie on tie.idProyectoUsuario = pu.idProyectoUsuario where tie.idProyectoUsuario = $idpu");
         while ($row = $query->fetch()) {
           $procesos[$row['idProceso']] += round($row['totalTiempo'] / 60,2);
         }

         $query = $this->db->connect()->query("select * from tiempos where idProyectoUsuario = $idpu");
         while($row = $query->fetch()){
           if(isset($tiempoPorc[$row['idFase']])){
             $tiempoPorc[$row['idFase']] += round($row['totalTiempo'] / 60, 2);
           }
         }

         $query = $this->db->connect()->query("select * from tiempos where idProyectoUsuario = $idpu");
         while ($row = $query->fetch()) {
           if(isset($tiempoPlaneacion[$row['idFase']])){
             $tiempoPlaneacion[$row['idFase']] += round($row['totalTiempo'] / 60, 2);
           }
         }

         $query = $this->db->connect()->query("select * from deteccionerrores where idProyectoUsuario = $idpu");
         while ($row = $query->fetch()) {
           $defectosTipo[$row['idErrorTipo']] += 1;
           $defectosTiempo[$row['idErrorTipo']] += round($row['tiempoSolucionar']/ 60 ,2);

           if(isset($defectosInyectados[$row['faseCreacionError']])){
             $defectosInyectados[$row['faseCreacionError']] += 1;
           }
           if(isset($defectosRemovidos[$row['faseEliminacionError']])){
             $defectosRemovidos[$row['faseEliminacionError']] += 1;
           }
         }

         $query = $this->db->connect()->query("select * from planresumenproyecto where idProyectoUsuario = $idpu");

         while ($row = $query->fetch()){
           $resumenProyecto += $row['actual'];
         }
       } // fin el foreach()
       // echo "<pre>";
       // var_dump($defectosTipo);

       $data['sumaTiempoProceso'] = $procesos;
       $data['tiempoPorc'] = $tiempoPorc;
       $data['tiempoPlaneacion'] = $tiempoPlaneacion;
       $data['defectosInyectados'] = $defectosInyectados;
       $data['defectosRemovidos'] = [
         'fase03' => ($defectosRemovidos['fase03'] == 0) ? 0 :($defectosRemovidos['fase03'] / $resumenProyecto) * 100,
         'fase04' => ($defectosRemovidos['fase04'] == 0) ? 0 :($defectosRemovidos['fase04'] / $resumenProyecto) * 100,
         'fase06' => ($defectosRemovidos['fase06'] == 0) ? 0 :($defectosRemovidos['fase06'] / $resumenProyecto) * 100,
         'fase07' => ($defectosRemovidos['fase07'] == 0) ? 0 :($defectosRemovidos['fase07'] / $resumenProyecto) * 100,
       ];
       $data['defectosTipo'] = $defectosTipo;
       $data['defectosTiempo'] = $defectosTiempo;
      return $data;
    }


    function getPivote($cedula){
      $query = $this->db->connect()->query("select * from proyectosusuarios where cedulaUsuario = $cedula");
      $data = [];
      while ($row = $query->fetch()) {
        $item = [
          'idpu' => $row['idProyectoUsuario'],
          'idp' => $row['idProyecto'],
        ];
        array_push($data, $item);
      }
      return $data;
    }
  }
?>
