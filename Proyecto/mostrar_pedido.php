<?php
session_start(); // Iniciamos sesión 

$db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
mysqli_set_charset($db, "utf8");

// Función para obtener el nombre del producto
function obtenerNombreProducto($productId, $db) {
    // Consulta SQL para obtener el nombre del producto
    $query = "SELECT nombre FROM productos WHERE id = $productId";

    // Ejecutar la consulta
    $result = $db->query($query);

    // Verificar si la consulta fue exitosa
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['nombre'];
    } else {
        return "Nombre no encontrado";
    }
}

// Función para obtener la imagen del producto
function obtenerImagenProducto($productId, $db) {
    // Consulta SQL para obtener la imagen del producto
    $query = "SELECT imagen FROM productos WHERE id = $productId";

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
function obtenerPrecioProducto($productId, $db) {
    // Consulta SQL para obtener el precio del producto
    $query = "SELECT precio FROM productos WHERE id = $productId";

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


// Función para mostrar el pedido
function mostrar_pedido($productId, $db) {
    // Resto del código para mostrar el pedido...
    
    // Ejemplo de uso de las funciones de productos
    $nombreProducto = obtenerNombreProducto($productId, $db);
    $imagenProducto = obtenerImagenProducto($productId, $db);
    $precioProducto = obtenerPrecioProducto($productId, $db);
    
    // Aquí puedes mostrar la información del producto en el pedido
    echo "Producto: $nombreProducto, Precio: $precioProducto, Imagen: $imagenProducto";
}
?>