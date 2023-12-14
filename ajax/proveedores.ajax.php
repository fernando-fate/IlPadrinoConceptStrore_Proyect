<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class ajaxProveedores{

    public function ajaxListarProveedores(){

        $proveedores = ProveedoresControlador::ctrListarProveedores();
        echo json_encode($proveedores);
    }

}

if(isset($_POST['accion']) && $_POST['accion']==1){

    $proveedores = new ajaxProveedores();
    $proveedores -> ajaxListarProveedores();
}