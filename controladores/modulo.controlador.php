<?php
class ModuloControlador{

    static public function ctrObtenerModulos(){
        $modulos = ModuloModelo::mdlObtenerModulos();

        return $modulos;
    }

    static public function ctrObtenerModulosPorPerfil($id_Perfil){
        $modulosPorPerfil = ModuloModelo::mdlObtenerModulosPorPerfil($id_Perfil);

        return $modulosPorPerfil;
    }

}