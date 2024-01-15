<?php
require_once "conexion.php";

class PerfilModuloModelo{

  static public function mdlRegistrarPerfilModulo($array_idModulos, $idPerfil, $id_modulo_inicio){

    $total_registro = 0;

    $tabla = "perfil_modulo";

    if($idPerfil == 1){
      $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_perfil = :id_perfil and id_modulo != 13");
    }
    else{
      $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_perfil = :id_perfil");
    }

    $stmt->bindParam(":id_perfil", $idPerfil, PDO::PARAM_INT);
    $stmt->execute();



    foreach ($array_idModulos as $value) {

      if($idPerfil == 1 && $value == 13){
        $total_registro = $total_registro + 0;
      }
      else{


        if($value == $id_modulo_inicio){
          $vista_inicio = 1;
        }
        else{
          $vista_inicio = 0;
        }

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_perfil, id_modulo, vista_inicio, estado) VALUES (:id_perfil, :id_modulo, :vista_inicio, 1)");

        $stmt->bindParam(":id_perfil", $idPerfil, PDO::PARAM_INT);
        $stmt->bindParam(":id_modulo", $value, PDO::PARAM_INT);
        $stmt->bindParam(":vista_inicio", $vista_inicio, PDO::PARAM_INT);


        if($stmt->execute()){
          $total_registro = $total_registro + 1;
        }
        else{
          $total_registro =  0;
        }
      }
      
    }
    return $total_registro;

  } 
}