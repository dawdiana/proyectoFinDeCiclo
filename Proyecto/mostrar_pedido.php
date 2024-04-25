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


// Función para mostrar el pedido

function mostrar_pedido($productId, $db) {
    // Ejemplo de uso de las funciones de productos
    $nombrePlato = obtenerNombrePlato($productId, $db);
    $imagenPlato = obtenerImagenPlato($productId, $db);
    $precioPlato = obtenerPrecioPlato($productId, $db);
    
    // Aquí puedes mostrar la información del producto en el pedido
    echo "Plato: $nombrePlato, Precio: $precioPlato, Imagen: $imagenPlato";
}

// Ejemplo de uso de la función mostrar_pedido
$productId = 1; // Aquí debes establecer el ID del producto que deseas mostrar
mostrar_pedido($productId, $db);

// Cerrar la conexión a la base de datos al final del script
$db->close();
?>