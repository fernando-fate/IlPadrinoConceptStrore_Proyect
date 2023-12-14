<?php


class CategoriasControlador{

    static public function ctrCargaMasivaCategorias($fileCategorias){
        
        $respuesta = CategoriasModelo::mdlCargaMasivaCategorias($fileCategorias);
        
        return $respuesta;
    }
    static public function ctrListarCategorias(){
        
        $categorias = CategoriasModelo::mdlListarCategorias();
        
        return $categorias;
    }
}