<?php
session_start(); // Iniciar sesión 

if (isset($_POST['productId'])) { // Verificar si se recibió el ID del producto a agregar al carrito
    $productId = $_POST['productId']; // Obtener el ID del producto
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Inicializar el carrito si no existe
    }
    $_SESSION['cart'][] = $productId; // Agregar el ID del producto al carrito (en este caso, simplemente lo agregamos al array)
    echo count($_SESSION['cart']);  // Devolver la cantidad total de productos en el carrito como respuesta
} else {
    echo "Error: No se recibió el ID del producto."; // Si no se ha recibido la ID del producto, devolvemos un mensaje de error
}
?>





<!--
session_start(); // Iniciar sesión 

if (isset($_POST['productId'])) { // Verificar si se recibió el ID del producto a agregar al carrito
    $productId = $_POST['productId']; // Obtener el ID del producto
    // Aquí podrías realizar cualquier lógica necesaria, como agregar el producto al carrito en la sesión
    // Por ejemplo, podrías almacenar el ID del producto en un array en la sesión
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Inicializar el carrito si no existe
    }
    $_SESSION['cart'][] = $productId; // Agregar el ID del producto al carrito (en este caso, simplemente lo agregamos al array)
    echo count($_SESSION['cart']);  // Devolver la cantidad total de productos en el carrito como respuesta
} else {
    echo "Error: No se recibió el ID del producto."; // Si no se ha recibido la ID del producto, devolvemos un mensaje de error
}
-->