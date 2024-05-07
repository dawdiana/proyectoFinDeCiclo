<?php
error_reporting(E_ERROR | E_PARSE);
session_start(); // Iniciamos sesión 

//Método para añadir productos al carrito

if (isset($_POST['productId'])) { // Verificamos que el id del producto no sea nulo
    $productId = $_POST['productId']; // Obtener el ID del producto
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Inicializamos el carrito si no existe
    }
    if (!isset($_SESSION['cart'][$productId]) || !is_array($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = array();
    }
    if (!isset($_SESSION['cart'][$productId]['cantidad']) ) {
        $_SESSION['cart'][$productId]['cantidad'] = array();
    }    

    $_SESSION['cart'][$productId]['cantidad'] = (int)$_SESSION['cart'][$productId]['cantidad'] + 1; // Agregamos el ID del producto al carrito (en este caso, simplemente lo agregamos al array)
    $sum=0;
    foreach ($_SESSION['cart'] as $key => $value) {        
        $sum = $sum + intval($value['cantidad']);
    }
    echo $sum;
} else {
    echo "Error: No se recibió el ID del producto."; // Mensaje de error en caso de que no se haya recibido la id del producto
}
?>




