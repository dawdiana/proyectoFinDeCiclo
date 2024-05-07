<?php

/*
    function obtenerValorCarrito($productId) {
        if(isset($_SESSION['cart'])) {

            $sum=0;
            foreach ($_SESSION['cart'] as $key => $value) {        
                $sum = $sum + intval($value['cantidad']);
            }    
            echo $sum;
        } else {
            echo 0;
        }
        
        }


    function sumarValorCarrito($productId) {
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
    }    

    function restarValorCarrito($productId) {
       
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
    }


*/

// OBTENER NOMBRE DEL PRODUCTO
function obtenerNombrePlato($productId, $db) {
    
    $query = "SELECT nombre FROM plato WHERE idPlato = $productId"; //Consulta SQL para obtener el nombre del producto
    $result = $db->query($query); //Ejecutar la consulta

    if ($result && $result->num_rows > 0) {  //Verificar si la consulta fue exitosa
        $row = $result->fetch_assoc();
        return $row['nombre'];
    } else {
        return "Nombre no encontrado";
    }
}

// OBTENER IMAGEN DEL PRODUCTO
function obtenerImagenPlato($productId, $db) {

    $query = "SELECT imagen FROM plato WHERE idPlato = $productId"; //Consulta SQL para obtener la imagen del producto
    $result = $db->query($query);  //Ejecutar la consulta

    if ($result && $result->num_rows > 0) { //Verificar si la consulta fue exitosa
        $row = $result->fetch_assoc();
        return $row['imagen'];
    } else {
        return "imagen_no_encontrada.jpg";
    }
}

// OBTENER PRECIO DEL PRODUCTO
function obtenerPrecioPlato($productId, $db) {

    $query = "SELECT precio FROM plato WHERE idPlato = $productId";  //Consulta SQL para obtener el precio del producto
    $result = $db->query($query);  //Ejecutar la consulta

    if ($result && $result->num_rows > 0) {  // Verificar si la consulta fue exitosa
        $row = $result->fetch_assoc();
        return $row['precio'];
    } else {
        return "Precio no encontrado";
    }
}


?>