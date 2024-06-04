<?php

/** Función que muestra el valor actual del carrito/ bolsa de la compra */

//Comienza la sesión
session_start();

//Comprueba que exista un carrito en la sesión
if(isset($_SESSION['cart'])) {

    //Variable que contendrá la suma de los productos del carrito
    $sum=0; 
    
    //recorre los elementos del carrito para sumarlos       
    foreach ($_SESSION['cart'] as $key => $value) { 
        $sum = $sum + intval($value['cantidad']);
    }    
   
    //Muestra la suma
    echo $sum; 

} else {
    
    //Si no existe el carrito (no tiene contenido), se muestra un "0"
    echo 0; 
}
?>

