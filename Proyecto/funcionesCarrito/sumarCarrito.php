<?php

/** Función que añade productos del carrito/ bolsa de la compra */


//Muestra solo los errores graves del código
error_reporting(E_ERROR | E_PARSE);

//Inicia la sesión 
session_start();

//Verifica que se haya recibido la id del producto a través de la solicitud post
if (isset($_POST['productId'])) { 

    //Asigna a una variable el id obtenido
    $productId = $_POST['productId'];

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




