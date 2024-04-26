<?php
error_reporting(E_ERROR | E_PARSE);
session_start(); // Iniciamos sesión

//Método para restar productos del carrito

if(isset($_POST['productId'])) { // Verificamos que se haya recibido la id del producto
    $productId = $_POST['productId']; // Obtenemos el ID del producto
    if(isset($_SESSION['cart'])) {  // Si el carrito está definido en la sesión
          
        if((int)$_SESSION['cart'][$productId]['cantidad']>0){
            $_SESSION['cart'][$productId]['cantidad'] = (int)$_SESSION['cart'][$productId]['cantidad'] - 1;
        }else{
            $_SESSION['cart'][$productId]['cantidad']=0;
        }
        

        if($_SESSION['cart'][$productId]['cantidad'] == 0) { // Y si el producto está en el carrito
            unset($_SESSION['cart'][$productId]); // lo eliminamos del carrito            
        }
        $sum=0;
        foreach ($_SESSION['cart'] as $key => $value) {
            $sum = $sum + intval($value['cantidad']);
        }
        echo $sum;
        
    } else {
        echo "Error: El carrito no está definido en la sesión."; // Si el carrito no está definido en la sesión, devolvemos un mensaje de error
    }
} else {
    echo "Error: No se recibió el ID del producto."; // Si no se ha recibido el ID del producto, devolvemos un mensaje de error
}
?>