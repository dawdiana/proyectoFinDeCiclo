<?php

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $idProducto = $_POST['idProducto'];
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $precio = $_POST['precio'];
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $imagen = $_POST['imagen']; // Asegúrate de validar y sanitizar esto correctamente

    // Hacer consulta para actualizar datos
    $query_update = "UPDATE plato SET nombre='$nombre', precio='$precio', descripcion='$descripcion', imagen='$imagen' WHERE idPlato='$idProducto'";

    // Ejecutar la consulta SQL
    if (mysqli_query($db, $query_update)) {
        echo "Los cambios se han guardado correctamente.";
    } else {
        echo "Error al guardar los cambios: " . mysqli_error($db);
    }
}
?>