<?php
session_start(); // Iniciamos sesión

//Método para restar productos del carrito

if(isset($_POST['productId'])) { // Verificamos que se haya recibido la id del producto
    $productId = $_POST['productId']; // Obtenemos el ID del producto
    if(isset($_SESSION['cart'])) {  // Si el carrito está definido en la sesión
        $index = array_search($productId, $_SESSION['cart']); // Buscamos el índice del producto en el carrito
        if($index !== false) { // Y si el producto está en el carrito
            unset($_SESSION['cart'][$index]); // lo eliminamos del carrito
            echo count($_SESSION['cart']); // Devolvemos la cantidad total de productos actual
        } else {
            echo "-"; //si la cantidad de un mismo producto en el carrito es menor a 0, marcamos el sñimbolo "-"
        }
    } else {
        echo "Error: El carrito no está definido en la sesión."; // Si el carrito no está definido en la sesión, devolvemos un mensaje de error
    }
} else {
    echo "Error: No se recibió el ID del producto."; // Si no se ha recibido el ID del producto, devolvemos un mensaje de error
}
?>