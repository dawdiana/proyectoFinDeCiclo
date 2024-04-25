<?php
    //session_start(); // Iniciamos sesión (ya está iniciado en mostrar_pedido)

     $db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
     mysqli_set_charset($db, "utf8");

    include 'mostrar_pedido.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu pedido</title>
    <link rel='stylesheet' href='pago.css'/>

</head>
<body>
    <div class="cabecera">
        <div class="d1">
             <img class="logo" src="Imagenes/logo.png" alt="Logo página"/>
        </div> 
         <div class="d2">
             <img class="icoCompra" src="Imagenes/iconocompra.png"/>
             <p id="cantidadCarrito">0</p> 
         </div>
     </div>
     
     <div class="cuerpo">
        <h1>Tu pedido</h1>
        <div class="contenedorPedido">
                 <?php mostrar_pedido($nombreProducto, $cantidad); ?>
        </div>
     </div>

     <div class="cuerpo">
        <h1>Tu pedido</h1>
        <div class="contenedorPedido">
            <?php
            session_start();
            if (isset($_SESSION['pedido'])) {
                $nombreProducto = $_SESSION['pedido']['nombre'];
                $cantidad = $_SESSION['pedido']['cantidad'];
                mostrar_pedido($nombreProducto, $cantidad);
            } else {
                echo "No hay detalles de pedido disponibles.";
            }
            ?>
        </div>
    </div>

</body>
</html>
<!--
        IMPORTANTE .> CERRAR LAS VARIABLES DE SESIÓN 

-->