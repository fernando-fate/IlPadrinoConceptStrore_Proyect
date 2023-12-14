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
$contenidoProveedor = $_POST['contenidoProveedor'];
$contenidoPropietario = $_POST['contenidoPropietario'];
$contenidoTelefono = $_POST['contenidoTelefono'];


// Llamar al procedimiento almacenado
try {
    $statement = $conexion->prepare("CALL InsertarProveedor(?,?,?)");
    
    // Vincular los parámetros con valores
    $statement->bindValue(1, $contenidoProveedor);
    $statement->bindValue(2, $contenidoPropietario);
    $statement->bindValue(3, $contenidoTelefono);



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
