<?php

require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProveedoresModelo{

    static public function mdlListarProveedores(){
        $stmt = Conexion::conectar()->prepare('call prc_ListarProveedores()');

        $stmt->execute();

        return $stmt->fetchAll();
    }


}
