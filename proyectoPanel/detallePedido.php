<?php

if (isset($_GET['id'])) {
    // Obtener el ID del pedido de la URL
    $idPedido = $_GET['id'];

    // Aquí deberías consultar la base de datos para obtener la información del pedido con el ID proporcionado
    // Supongamos que aquí obtienes la información del pedido correspondiente

    // Simulación de información del pedido
    $nombreCliente = "John Doe";
    $fechaPedido = "2024-05-03";
    $estadoPedido = "En proceso";
} else {
    // Si no se proporciona el ID del pedido, redirigir a alguna otra página o mostrar un mensaje de error
    header("Location: alguna_pagina_de_error.php");
    exit; // Salir del script para evitar que se siga ejecutando
}

    $query = "select * from pedido where idPedido like '' "



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del pedido</title>
    <link rel='stylesheet' href='detallePedido.css'/>
</head>
<body>
    <div class="cabecera">
        <div class="contIcono">
            <a href="listaPedidos.php"><img class="iconoCasa" src='imagenesPanel/iconoCasa2.png' alt="Icono de casa"/></a>
        </div>
        <div class="contLogo">
            <img class="logo" src="imagenesPanel/logoOrderMaster.png" alt="Imagen logo"/>
        </div>    
    </div>


        <h2>Detalle del Pedido</h2>
        <p>Información del pedido:</p>
</body>
</html>





