<?php
  Class GestionProyetoModel extends Model{
    function __construct(){
      parent::__construct();
    }

    function getListado($cedula){
      $query = $this->db->connect()->query("select * from proyectos as pro inner join proyectosusuarios as pu on pro.idProyecto = pu.idProyecto where pu.cedulaUsuario = $cedula");
      $data = [];
      while ($row = $query->fetch()) {
        $item  = [
          'idProyecto' => $row['idProyecto'],
          'nombre' => $row['nombre'],
          'descripcion' => $row['descripcion'],
          'idMedida' => $row['idMedida'],
          'idProceso' => $row['idProceso'],
          'fechaIn' => $row['fechaIn'],
          'fechaOut' => $row['fechaOut'],
          'terminado' => $row['terminado'],
          'cedulaUsuario' => $row['cedulaUsuario'],
        ];
        array_push($data, $item);
      }

      return $data;
    }


    function validarAsociado($cedula, $codigo){

      $query = $this->db->connect()->query("select * from usuarios as us inner join proyectosusuarios as pu on us.cedulaUsuario = pu.cedulaUsuario where us.cedulaUsuario = $cedula AND pu.idProyecto = $codigo");

      $row = $query->fetch();
      if($row){
        $data = [
          'idProyectoUsuario' =>  $row['idProyectoUsuario'],
          'idProyecto' => $row['idProyecto'],
          'cedulaUsuario' => $row['cedulaUsuario'],
          'terminado' => $row['terminado'],
        ];
        return $data;
      }
      return null;
    }

    function validarListadoAsociado($cedula){
      $query = $this->db->connect()->query("select * from usuarios as us inner join proyectosusuarios as pu on us.cedulaUsuario = pu.cedulaUsuario where us.cedulaUsuario = $cedula");
      $data = [];
      while($row = $query->fetch()){
        $item = [
          'idProyectoUsuario' =>  $row['idProyectoUsuario'],
          'idProyecto' => $row['idProyecto'],
          'cedulaUsuario' => $row['cedulaUsuario'],
          'terminado' => $row['terminado'],
        ];

        array_push($data, $item);
      }
      return $data;
    }


    function getListadoProgramadoresAsociados($codigo){
        $query = $this->db->connect()->query("select * from usuarios");
        $data = [];
        while ($row = $query->fetch()){
						$item = [
								'cedula' => $row['cedulaUsuario'],
								'nombre' => $row['nombre'],
								'apellido' => $row['apellido'],
								'email' => $row['email'],
								'user' => $row['user'],
								'empresa' => $row['empresa'],
								'experiencia' => $row['experiencia'],
								'estado' =>  $row['estado'], #$row['proyecto']
								'foto' => $row['foto'],
								'titulo' => $row['idTitulo'],
                'asociado' => $this->validarAsociado($row['cedulaUsuario'], $codigo)
						];
						array_push($data, $item);
				}
        return $data;
    }


    function asociar($cedula, $codigo){
      if($this->validarAsociado($cedula, $codigo) == null){
        $query = $this->db->connect()->prepare('insert into proyectosusuarios(idProyectoUsuario, idProyecto, cedulaUsuario, terminado) values (:idProyectoUsuario, :idProyecto, :cedulaUsuario, :terminado)');
        $query->execute([
          'idProyectoUsuario' => getdate()[0],
          'idProyecto' => $codigo,
          'cedulaUsuario' => $cedula,
          'terminado' => 0
        ]);
        return true;
      }

      return false;
    }

    function desasociar($cedula, $codigo){
        $query = $this->db->connect()->prepare('delete from proyectosusuarios where idProyectoUsuario = :id');
        if($this->validarAsociado($cedula, $codigo) != null){
        $query->execute([
          'id' => $this->validarAsociado($cedula, $codigo)['idProyectoUsuario']
        ]);
        return true;
      }

      return false;
    }

    function terminar($cedula, $codigo){
      // echo "terminando proyecto $codigo del programador $cedula";

      $idProyectosUsuarios = $this->validarAsociado($cedula, $codigo)['idProyectoUsuario'];
      $query = $this->db->connect()->prepare('update proyectosusuarios set terminado = :terminado where idProyectoUsuario = :id');
      $query->execute([
        'terminado' => 1,
        'id' => $idProyectosUsuarios
      ]);
    }

    // function get($id){
    //   $query = $this->db->connect()->prepare("SELECT * FROM proyectos WHERE idProyecto = :id");
    //   $query->execute([
    //     'id' => $id
    //   ]);
    //   $row = $query->fetch();
    //   $item  = [
    //     'idProyecto' => (isset($row['idProyecto'])) ? $row['idProyecto'] : "",
    //     'nombre' => (isset($row['nombre'])) ? $row['nombre'] : "",
    //     'descripcion' => (isset($row['descripcion'])) ? $row['descripcion'] : "",
    //     'idMedida' => (isset($row['idMedida'])) ? $row['idMedida'] : "",
    //     'idProceso' => (isset($row['idProceso'])) ? $row['idProceso'] : "",
    //     'fechaIn' => (isset($row['fechaIn'])) ? $row['fechaIn'] : "",
    //     'fechaOut' => (isset($row['fechaOut'])) ? $row['fechaOut'] : "",
    //     'cedulaAdministrador' => (isset($row['cedulaAdministrador'])) ? $row['cedulaAdministrador'] : "",
    //   ];
    //
    //   return $item;
    // }

  }

?>
