<?php
session_start(); // Iniciamos sesión 

//Método para añadir productos al carrito

if (isset($_POST['productId'])) { // Verificamos que el id del producto no sea nulo
    $productId = $_POST['productId']; // Obtener el ID del producto
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Inicializamos el carrito si no existe
    }
    $_SESSION['cart'][] = $productId; // Agregamos el ID del producto al carrito (en este caso, simplemente lo agregamos al array)
    echo count($_SESSION['cart']);  // Devolvemos la cantidad total de productos en el carrito como respuesta
} else {
    echo "Error: No se recibió el ID del producto."; // Mensaje de error en caso de que no se haya recibido la id del producto
}
?>




