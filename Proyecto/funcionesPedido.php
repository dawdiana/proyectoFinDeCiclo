<?php

// OBTENER NOMBRE DEL PRODUCTO
function obtenerNombrePlato($productId, $db) {
    
    $query = "SELECT nombre FROM plato WHERE idPlato = $productId"; //Consulta SQL para obtener el nombre del producto
    $result = $db->query($query); //Ejecutar la consulta

    if ($result && $result->num_rows > 0) {  //Verificar si la consulta fue exitosa
        $row = $result->fetch_assoc();
        return $row['nombre'];
    } else {
        return "Nombre no encontrado";
    }
}

// OBTENER IMAGEN DEL PRODUCTO
function obtenerImagenPlato($productId, $db) {

    $query = "SELECT imagen FROM plato WHERE idPlato = $productId"; //Consulta SQL para obtener la imagen del producto
    $result = $db->query($query);  //Ejecutar la consulta

    if ($result && $result->num_rows > 0) { //Verificar si la consulta fue exitosa
        $row = $result->fetch_assoc();
        return $row['imagen'];
    } else {
        return "imagen_no_encontrada.jpg";
    }
}

// OBTENER PRECIO DEL PRODUCTO
function obtenerPrecioPlato($productId, $db) {

    $query = "SELECT precio FROM plato WHERE idPlato = $productId";  //Consulta SQL para obtener el precio del producto
    $result = $db->query($query);  //Ejecutar la consulta

    if ($result && $result->num_rows > 0) {  // Verificar si la consulta fue exitosa
        $row = $result->fetch_assoc();
        return $row['precio'];
    } else {
        return "Precio no encontrado";
    }
}


?>