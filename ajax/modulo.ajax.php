<?php
require_once "../controladores/modulo.controlador.php";
require_once "../modelos/modulo.modelo.php";

class AjaxModulos{

    public function ajaxObtenerModulos(){

        $modulos = ModuloControlador::ctrObtenerModulos();

        echo json_encode($modulos);
    }

    public function ajaxObtenerModulosPorPerfil($id_Perfil){

        $modulos = ModuloControlador::ctrObtenerModulosPorPerfil($id_Perfil);

        echo json_encode($modulos);
    }


}


if(isset($_POST['accion']) && $_POST['accion'] == 1){
    $modulos = new AjaxModulos;
    $modulos -> ajaxObtenerModulos();
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){
    $modulos = new AjaxModulos;
    $modulos -> ajaxObtenerModulosPorPerfil($_POST['id_Perfil']);
}