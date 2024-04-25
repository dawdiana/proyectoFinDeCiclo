<?php
session_start(); // Iniciar sesión si aún no está iniciada

// Verificar si se recibió el ID del producto a eliminar del carrito
if(isset($_POST['productId'])) {
    $productId = $_POST['productId']; // Obtener el ID del producto

    // Verificar si el carrito está definido en la sesión
    if(isset($_SESSION['cart'])) {
        // Buscar el índice del producto en el carrito
        $index = array_search($productId, $_SESSION['cart']);

        // Si el producto está en el carrito
        if($index !== false) {
            // Eliminar el producto del carrito
            unset($_SESSION['cart'][$index]);

            // Devolver la cantidad total de productos en el carrito como respuesta
            echo count($_SESSION['cart']);
        } else {
            echo "-";
        }
    } else {
        // Si el carrito no está definido en la sesión, devolver un mensaje de error
        echo "Error: El carrito no está definido en la sesión.";
    }
} else {
    // Si no se recibió el ID del producto, devolver un mensaje de error
    echo "Error: No se recibió el ID del producto.";
}
?>