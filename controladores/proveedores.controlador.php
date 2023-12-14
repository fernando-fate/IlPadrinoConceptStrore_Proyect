<?php


class ProveedoresControlador{

    
    static public function ctrListarProveedores(){
        
        $proveedores = ProveedoresModelo::mdlListarProveedores();
        
        return $proveedores;
    }
}