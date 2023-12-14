<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelos.php";

require_once "../vendor/autoload.php";

class ajaxCategorias{

    public $fileCategorias;

    public function ajaxCargaMasivaCategorias(){

        $respuesta = CategoriasControlador::ctrCargaMasivaCategorias($this->fileCategorias);

        echo json_encode($respuesta);
    }

    public function ajaxListarCategorias(){

        $categorias = CategoriasControlador::ctrListarCategorias();
        echo json_encode($categorias);
    }

}

if(isset($_POST['accion']) && $_POST['accion']==1){

    $categorias = new ajaxCategorias();
    $categorias -> ajaxListarCategorias();


}else if(isset($_FILES)){
    $archivo_categorias = new ajaxCategorias();
    $archivo_categorias-> fileCategorias = $_FILES['fileCategorias'];
    $archivo_categorias -> ajaxCargaMasivaCategorias();
}