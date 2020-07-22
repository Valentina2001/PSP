<?php
  Class AdministradorModel extends Model{
    function __construct(){
      parent::__construct();
    }


    function getAdministrador($cedula = "nada"){

      $informacionBase = $this->db->connect()->query("SELECT * FROM administradores WHERE cedulaAdministrador = '$cedula'");
      $row = $informacionBase->fetch();
      $item = [
        'cedula' => $row['cedulaAdministrador'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'email' => $row['email'],
        'user' => $row['usuario'],
        'foto' => $row['foto'],
        'password' => $row['password'],
      ];

      return $item;
    }

    function update($data){
      if($data['foto'] == -1){
        $query = $this->db->connect()->prepare("UPDATE administradores SET nombre = :nombre, apellido = :apellido, email = :email, usuario = :usuario where cedulaAdministrador = :cedula");
        $query->execute([
          'cedula' => $data['cedula'],
          'nombre' => $data['nombre'],
          'apellido' => $data['apellido'],
          'email' => $data['email'],
          'usuario' => $data['usuario']
        ]);
        return true;


      }

      $query = $this->db->connect()->prepare("UPDATE administradores SET nombre = :nombre, apellido = :apellido, email = :email, foto = :foto, usuario = :usuario where cedulaAdministrador = :cedula");


      $query->execute([
        'cedula' => $data['cedula'],
        'nombre' => $data['nombre'],
        'apellido' => $data['apellido'],
        'email' => $data['email'],
        'usuario' => $data['usuario'],
        'foto' => $data['foto']
      ]);
      return true;
    }
    function getPassword($cedula, $password){
      $query = $this->db->connect()->prepare("UPDATE administradores SET password = :password WHERE cedulaAdministrador = :cedula");
      $query->execute([
        'cedula' => $cedula,
        'password' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]) ,
      ]);
    }
  }
?>
