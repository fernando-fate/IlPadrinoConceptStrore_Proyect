<?php

require_once "conexion.php";

class ModuloModelo{

    static public function mdlObtenerModulos(){
        $stmt = Conexion::conectar()
                                ->prepare("select id as id,
                                                        (case when padre_id is null then '#' else padre_id end) as parent,
                                                        modulo as text,
                                                        vista
                                            from modulos m
                                            order by m.id");
        $stmt -> execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    static public function mdlObtenerModulosPorPerfil($id_Perfil){
        $stmt = Conexion::conectar()
        ->prepare("select m.id as id,
                        m.modulo,
                        IFNULL(case when(m.vista is null or m.vista = '') then '0' else (
                            (select '1' from perfil_modulo pm where pm.id_modulo = m.id and pm.id_perfil = :id_Perfil)
                        ) end, 0) as sel
            from modulos m
            order by m.id");
        $stmt -> bindParam(":id_Perfil", $id_Perfil, PDO::PARAM_INT);
        $stmt -> execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}