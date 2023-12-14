<?php
// Conexión a la base de datos
try {
    $conexion = new PDO("mysql:host=localhost;dbname=market-pos", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // Configurar el modo de error de PDO para lanzar excepciones en lugar de advertencias
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Obtener los datos del formulario
$contenidoCodigo = $_POST['contenidoCodigo'];
$contenidoCategoria = $_POST['contenidoCategoria'];
$contenidoDescripcion = $_POST['contenidoDescripcion'];
$contenidoProveedor = $_POST['contenidoProveedor'];
$contenidoPrecioVenta = $_POST['contenidoPrecioVenta'];
$contenidoStock = $_POST['contenidoStock'];

// Llamar al procedimiento almacenado
try {
    $statement = $conexion->prepare("CALL InsertarProducto(?, ?, ?, ?, ?, ?)");
    
    // Vincular los parámetros con valores
    $statement->bindValue(1, $contenidoCodigo);
    $statement->bindValue(2, $contenidoCategoria);
    $statement->bindValue(3, $contenidoDescripcion);
    $statement->bindValue(4, $contenidoProveedor);
    $statement->bindValue(5, $contenidoPrecioVenta, PDO::PARAM_INT);  // Especificar el tipo de dato como INT
    $statement->bindValue(6, $contenidoStock, PDO::PARAM_INT);  // Especificar el tipo de dato como INT

    // Ejecutar la consulta
    if ($statement->execute()) {
        echo "Inserción exitosa";
    } else {
        echo "Error en la inserción: " . implode(", ", $statement->errorInfo());
    }
} catch (PDOException $e) {
    echo "Error en la inserción: " . $e->getMessage();
}

// Cerrar la conexión
$conexion = null;
?>
