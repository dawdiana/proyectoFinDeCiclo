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