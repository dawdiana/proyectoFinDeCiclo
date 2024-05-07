<?php

    //EVITAMOS QUE NOS APAREZCAN WARNINGS CUANDO EL CARRITO ESTÉ VACÍO 
    error_reporting(E_ERROR | E_PARSE);

    //INICIAMOS LA SESIÓN
    session_start();

    //INCLUÍMOS EL ARCHIVO DE FUNCIONES
    include 'funcionesPedido.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        
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
            $sqlInsertCliente = "INSERT INTO cliente (idCliente, nombre, apellido1, apellido2, correoE) VALUES ('','$nombreCliente', '$apellido1', '$apellido2', '$correoE')";
            if ($db->query($sqlInsertCliente) === TRUE) {
                echo "Nuevo cliente insertado correctamente.";
                    // OBTENER ID DEL CLIENTE CREADO
                    $idCliente = $db->insert_id; 
           
            } else {
                echo "Error al insertar cliente: " . $db->error;
            }
       
        } else {
            echo "El cliente ya está registrado.";
            // OBTENER ID DEL CLIENTE EXISTENTE
            $row = $result1->fetch_assoc(); 
            $idCliente = $row['idCliente'];
        }



        //CÁLCULO DEL PRECIO TOTAL DEL PEDIDO
        if(count($_SESSION['cart']) > 0){
           
            $pTotalPedido = 0;
            
            foreach ($_SESSION['cart'] as $productId => $aDatos) {
                
                $productoPrecio = obtenerPrecioPlato($productId, $db);
                $pTotalLinea = $aDatos['cantidad'] * $productoPrecio; //precio de la unidad por la cantidad
                $pTotalPedido = $pTotalPedido + $pTotalLinea; //precio total del pedido
            }
        }


        //Guardar datos del envío en tabla pedidos
        $sqlInsertPedido = "INSERT INTO pedido (fk_idCliente, fechaPedido, precioPedido, tipoEntrega, direccion, codPostal, poblacion)
            VALUES ('$idCliente',now(),'$pTotalPedido','$tipoEntrega','$direccion','$codPostal','$poblacion')";
        

        //Comprobar que los datos hayan sido guardados con éxito
        if ($db->query($sqlInsertPedido) === TRUE) {
            echo "Nuevo pedido insertado correctamente.";
            $idPedido = $db->insert_id;
        } else {
            echo "Error al insertar pedido: " . $db->error;
        }



        //GUARDAR LINEA/S DE PEDIDO
        if(count($_SESSION['cart']) > 0){

            foreach ($_SESSION['cart'] as $productId => $aDatos){

                $productoPrecio = obtenerPrecioPlato($productId, $db);
                $productoNombre = obtenerNombrePlato($productId, $db);
                $productoCantidad = $aDatos['cantidad'];

                $sqlInsertLineaPedido = "INSERT INTO LineaPedido (fk_idPedido, fk_idPlato, cantidad, nombrePlato, precioUnidad)
                VALUES ('$idPedido','$productId','$productoCantidad','$productoNombre','$productoPrecio')";

                    if ($db->query($sqlInsertLineaPedido) === TRUE) {
                        echo "Nueva/s línea/s de pedido insertada/s.";
                    } else {
                        echo "Error al insertar pedido: " . $db->error;
                    }
            }

        }

    }



?>