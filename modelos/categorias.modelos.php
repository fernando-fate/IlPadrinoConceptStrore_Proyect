<?php

require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

class CategoriasModelo{

    static public function mdlCargaMasivaCategorias($fileCategorias){

        $nombreArchivo = $fileCategorias['tmp_name'];

        $documento = IOFactory::load($nombreArchivo);

       $hojaCategorias = $documento->getSheet(0);
       $numeroFilasCategorias = $hojaCategorias->getHighestRow();
        
        /*$hojaProductos = $documento->getSheet(0);
        $numeroFilasProductos = $hojaProductos->getHighestRow();*/

        $categoriasRegistradas = 0;
        //$productosRegistrados = 0;

        // CICLO FOR PARA REGISTROS DE CATEGORIAS
        for ($i = 2; $i <= $numeroFilasCategorias; $i++) 
        { 
            $categoria = $hojaCategorias->getCellByColumnAndRow(1, $i)->getValue();
            $fecha_actualizacion = date("Y-m-d");

            if(!empty($categoria)){
                $stmt = Conexion::conectar()->prepare("INSERT INTO categorias(nombre_categoria,
                                                                                fecha_actualizacion_categoria)
                                                                    VALUES(:nombre_categoria,
                                                                            :fecha_actualizacion_categoria);");

                $stmt->bindParam(":nombre_categoria", $categoria, PDO::PARAM_STR);
                $stmt->bindParam(":fecha_actualizacion_categoria", $fecha_actualizacion, PDO::PARAM_STR);

                if($stmt->execute()){
                    $categoriasRegistradas++;
                }
            }           
        }

            // CICLO FOR PARA REGISTROS DE PRODUCTOS
            /*for ($i = 2; $i <= $numeroFilasProductos; $i++) { 
                $codigo_producto = $hojaProductos->getCell("A".$i)->getValue();
                $id_categoria_producto = ProductosModelo::mdlBuscarIdCategoria($hojaProductos->getCell("B".$i)->getValue());
                $descripcion_producto = $hojaProductos->getCell("C".$i)->getValue();
                $precio_compra_producto = $hojaProductos->getCell("D".$i)->getValue();
                $precio_venta_producto = $hojaProductos->getCell("E".$i)->getValue();
                $utilidad = $hojaProductos->getCell("F".$i)->getValue();
                $stock_producto = $hojaProductos->getCell("G".$i)->getValue();
                $minimo_stock_producto = $hojaProductos->getCell("H".$i)->getValue();
                $ventas_producto = $hojaProductos->getCell("I".$i)->getValue();
                $fecha_actualizacion_producto = date('Y-m-d');

                if(!empty($codigo_producto)){
                    $stmt = Conexion::conectar()->prepare("INSERT INTO productos(codigo_producto,
                                                                                id_categoria_producto,
                                                                                descripcion_producto,
                                                                                precio_compra_producto,
                                                                                precio_venta_producto,
                                                                                utilidad,
                                                                                stock_producto,
                                                                                minimo_stock_producto,
                                                                                ventas_producto,
                                                                                fecha_actualizacion_producto)
                                                                        VALUES(:codigo_producto,
                                                                                :id_categoria_producto,
                                                                                :descripcion_producto,
                                                                                :precio_compra_producto,
                                                                                :precio_venta_producto,
                                                                                :utilidad,
                                                                                :stock_producto,
                                                                                :minimo_stock_producto,
                                                                                :ventas_producto,
                                                                                :fecha_actualizacion_producto);");

                    $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":id_categoria_producto", $id_categoria_producto[0], PDO::PARAM_STR);
                    $stmt->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":precio_compra_producto", $precio_compra_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":precio_venta_producto", $precio_venta_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":utilidad", $utilidad, PDO::PARAM_STR);
                    $stmt->bindParam(":stock_producto", $stock_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":minimo_stock_producto", $minimo_stock_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":ventas_producto", $ventas_producto, PDO::PARAM_STR);
                    $stmt->bindParam(":fecha_actualizacion_producto", $fecha_actualizacion_producto, PDO::PARAM_STR);

                    if($stmt->execute()){
                        $productosRegistrados++;
                    }
                }
            
        }*/
        
        $respuesta["totalCategorias"] = $categoriasRegistradas;
        //$respuesta["totalProductos"] = $productosRegistrados;

        return $respuesta;
    }

   /* static public function mdlBuscarIdCategoria($nombreCategoria){

        $stmt = Conexion::conectar()->prepare("SELECT id_categoria FROM categorias WHERE nombre_categoria = :nombreCategoria");
        $stmt->bindParam(":nombreCategoria", $nombreCategoria, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();

    }*/
    static public function mdlListarCategorias(){
        $stmt = Conexion::conectar()->prepare('call prc_ListarCategorias()');

        $stmt->execute();

        return $stmt->fetchAll();
    }


}
