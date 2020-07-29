<?php

  function imprimirMensaje($data){
    // echo "<pre>";
    // var_dump($data);

    echo "
    <div class='col-12 col-md-4'>
      <table class='table table-borbered table-sm'>
        <tr class='table-info'>
          <td colspan='2'>Desarrollo actual del tiempo</td>
        </tr>
        <tr class='table-primary'>
          <th scope='col'>Fase</th>
          <th scope='col'>Tiempo</th>
        </tr>
        <tr>
          <th>Planeación</th>
          <td>".$data['totalTiempo']['fase01']."</td>
        </tr>
        <tr>
          <th>Diseño</th>
          <td>".$data['totalTiempo']['fase02']."</td>
        </tr>
        <tr>
          <th>Diseño revisado</th>
          <td>".$data['totalTiempo']['fase03']."</td>
        </tr>
        <tr>
          <th>Código</th>
          <td>".$data['totalTiempo']['fase04']."</td>
        </tr>
        <tr>
          <th>Código revisado</th>
          <td>".$data['totalTiempo']['fase05']."</td>
        </tr>
        <tr>
          <th>Compilación</th>
          <td>".$data['totalTiempo']['fase06']."</td>
        </tr>
        <tr>
          <th>Puebas Unitarias</th>
          <td>".$data['totalTiempo']['fase07']."</td>
        </tr>
        <tr>
          <th>Post Mortem</th>
          <td>".$data['totalTiempo']['fase08']."</td>
        </tr>
      </table>
    </div>
    ";

    echo "
    <div class='col-12 col-md-4'>
      <table class='table table-borbered table-sm'>
        <tr class='table-info'>
          <td colspan='2'>Defectos inyectados</td>
        </tr>
        <tr class='table-primary'>
          <th scope='col'>Fase</th>
          <th scope='col'></th>
        </tr>
        <tr>
          <th>Diseño</th>
          <td>".$data['defectosDC']['desing']."</td>
        </tr>
        <tr>
          <th>Código</th>
          <td>".$data['defectosDC']['codigo']."</td>
        </tr>
      </table>
    </div>
    ";
    echo "
    <div class='col-12 col-md-4'>
      <table class='table table-borbered table-sm'>
        <tr class='table-info'>
          <td colspan='2'>Defectos removidos</td>
        </tr>
        <tr class='table-primary'>
          <th scope='col'>Fase</th>
          <th scope='col'></th>
        </tr>
        <tr>
          <th>Revisión diseño</th>
          <td>".$data['defectosRemovidos']['revisionDesign']."</td>
        </tr>
        <tr>
          <th>Revisión código</th>
          <td>".$data['defectosRemovidos']['revicionCodigo']."</td>
        </tr>
        <tr>
          <th>Compilación</th>
          <td>".$data['defectosRemovidos']['compilacion']."</td>
        </tr>
        <tr>
          <th>Pruebas Unitarias</th>
          <td>".$data['defectosRemovidos']['pu']."</td>
        </tr>
      </table>
    </div>
    ";
  }
?>
