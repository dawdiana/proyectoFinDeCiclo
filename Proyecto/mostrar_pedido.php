<?php
session_start(); // Iniciamos sesión 

$db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
mysqli_set_charset($db, "utf8");

// Función para obtener el nombre del producto
function obtenerNombrePlato($productId, $db) {
    $query = "SELECT nombre FROM plato WHERE idPlato = $productId";     // Consulta SQL para obtener el nombre del producto

    
    $result = $db->query($query); // Ejecutar la consulta

    // Verificar si la consulta fue exitosa
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['nombre'];
    } else {
        return "Nombre no encontrado";
    }
}

// Función para obtener la imagen del producto
function obtenerImagenPlato($productId, $db) {
    // Consulta SQL para obtener la imagen del producto
    $query = "SELECT imagen FROM plato WHERE idPlato = $productId";

    // Ejecutar la consulta
    $result = $db->query($query);

    // Verificar si la consulta fue exitosa
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['imagen'];
    } else {
        return "imagen_no_encontrada.jpg";
    }
}

// Función para obtener el precio del producto
function obtenerPrecioPlato($productId, $db) {
    // Consulta SQL para obtener el precio del producto
    $query = "SELECT precio FROM plato WHERE idPlato = $productId";

    // Ejecutar la consulta
    $result = $db->query($query);

    // Verificar si la consulta fue exitosa
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['precio'];
    } else {
        return "Precio no encontrado";
    }
}







print_r($_SESSION);

mostrar_pedido($productId, $db);

$db->close();
?>