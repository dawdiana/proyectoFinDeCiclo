<?php

    include 'mostrar_pedido.php';

    if ($_SERVER[REQUEST_METHOD] == 'POST') { 
        
    //VARIABLES PARA ALMACENAR DATOS DEL FORMULARIO
        $nombreCliente = $_POST['nombre']; 
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $correoE = $_POST['correoE'];
        $tipoEntrega = $_POST['tipoEntrega'];
        $direccion = $_POST['direccion'];
        $codPostal = $_POST['cp'];
        $poblacion = $_POST['pob'];
         
        
        //CONEXIÓN A LA BASE DE DATOS
        $db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
        mysqli_set_charset($db, "utf8");


        // COMPROBACIÓN DE SI EL CLIENTE YA EXISTE EN LA BASE DE DATO (SINO, SE GUARDA)
        $query1 = "select idCliente from cliente where correoE ='$correoE'";
        
        $result1 = $db->query($query1); 

        if ($result1->num_rows < 1) {
            $sqlInsertCliente = "INSERT INTO cliente (idCliente, nombre, apellido1, apellido2, correoE) VALUES ('','$nombreCliente', '$apellido1Cliente', '$apellido2Cliente', '$correoE')";
            if ($db->query($sqlInsertCliente) === TRUE) {
                echo "Nuevo cliente insertado correctamente.";

                    $idCliente = $db->insert_id;  // OBTENER ID DEL CLIENTE CREADO
           
            } else {
                echo "Error al insertar cliente: " . $db->error;
            }
       
        } else {
            echo "El cliente ya está registrado.";
            
            $row = $result1->fetch_assoc(); // // OBTENER ID DEL CLIENTE EXISTENTE
            $idCliente = $row['idCliente'];
        }



        //CÁLCULO DEL PRECIO TOTAL DEL PEDIDO
        if(count($_SESSION['cart']) > 0){
            $precio=0;
            foreach ($_SESSION['cart'] as $productId => $aDatos) {
                
                $productoPrecio = obtenerPrecioPlato($productId, $db);

               // $precioProducto = $aDatos['precio']; //precio de una unidad del producto
                $pTotalProducto = $aDatos['cantidad'] * $productoPrecio; //precio de la unidad por la cantidad
                $pTotalPedido = $pTotalPedido + $pTotalProducto; //precio total del pedido
            }
        }


        //Guardar datos del envío en tabla pedidos
        $sqlInsertPedido = "INSERT INTO pedido (fk_idCliente, fechaPedido, precioPedido, tipoEntrega, direccion, codPostal, poblacion)
            VALUES ('$idCliente','now()','$pTotalPedido','$direccion','$codPostal','$poblacion')";
        

        //Comprobar que los datos hayan sido guardados con éxito
        if ($db->query($sqlInsertPedido) === TRUE) {
            echo "Nuevo pedido insertado correctamente.";

            $idPedido = $db->insert_id;

        } else {
            echo "Error al insertar pedido: " . $db->error;
        }


        //Sacar id del plato
        


        //Guardar los productos pedidos ($_SESSION) en la tabla lineasPedido
        if(count($_SESSION['cart']) > 0){

            foreach ($_SESSION['cart'] as $productId => $aDatos){
                $sqlInsertLineaPedido = "INSERT INTO LineaPedido (fk_idPedido, fk_idPlato, cantidad, nombrePlato, precioUnidad)
                VALUES ('$idPedido','$idPlato','$pTotalPedido','$direccion','$codPostal','$poblacion')";
            
            }

        }

    }

?>