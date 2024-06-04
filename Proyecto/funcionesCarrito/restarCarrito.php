<?php

/** Función que resta productos del carrito/ bolsa de la compra */

error_reporting(E_ERROR | E_PARSE);  //Muestra solo los errores graves del código
session_start();  //Inicia la sesión

if(isset($_POST['productId'])) {  //Verifica que se haya recibido la id del producto a través de la solicitud post
    $productId = $_POST['productId'];  //Asigna a una variable el id obtenido
   
    if(isset($_SESSION['cart'])) {  //Si el carrito está definido en la sesión (no está vacío)
        if((int)$_SESSION['cart'][$productId]['cantidad']>0){  //Y la cantidad del producto a restar es superior a "0"
            $_SESSION['cart'][$productId]['cantidad'] = (int)$_SESSION['cart'][$productId]['cantidad'] - 1; // La cantidad actual es igual a "cantidad -1"
        }else{
            $_SESSION['cart'][$productId]['cantidad']=0;  //En caso de que la cantidad del producto en el carrito sea menor o igual a 0, se deja en cero       
        }
        
    
        if($_SESSION['cart'][$productId]['cantidad'] == 0) {  //Si el carrito es igual a cero, se elimina ese producto del carrito 
            unset($_SESSION['cart'][$productId]);        
        }
        
        $sum=0;  //La variable de suma queda en cero

        foreach ($_SESSION['cart'] as $key => $value) {  //Vuelve a recorrer el contenido del carrito y a sumar las cantidades restantes
            $sum = $sum + intval($value['cantidad']);
        }
        
        echo $sum; //Muestra esas cantidades
        
        } else {
            echo "Error: El carrito no está definido en la sesión."; // Si el carrito no está definido en la sesión, devolvemos un mensaje de error
        }
        
} else {
   
    echo "Error: No se recibió el ID del producto."; // Si no se ha recibido el ID del producto, devolvemos un mensaje de error
}
?>