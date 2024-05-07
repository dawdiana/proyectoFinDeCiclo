<?php

if (isset($_GET['id'])) {
    // Obtener el ID del pedido de la URL
    $idPedido = $_GET['id'];


    //que me interesa coger del pedido? tipo de pedido? me entra que segun sea a domicilio o 
    //o a recogida salgan diferentes opciones de select?

        $query = "SELECT plato.nombre AS nombrePlato, lineapedido.cantidad AS unidadesPlato, 
            plato.precio as precioPlato, pedido.estadoPedido,  
            CONCAT(cliente.nombre, ' ', cliente.apellido1, ' ', cliente.apellido2) AS nombreCliente,
            pedido.direccion
            FROM lineapedido
            INNER JOIN plato ON lineapedido.fk_idPlato = plato.idPlato
            INNER JOIN pedido ON lineapedido.fk_idPedido = pedido.idPedido
            INNER JOIN cliente ON pedido.fk_idCliente = cliente.idCliente
            WHERE lineapedido.fk_idPedido = '$idPedido'";
    
    $result = mysqli_query($db, $query);
        if (!$result) {
            die("Error en la consulta: " . mysqli_error($db));
        }


} else {
    // Si no se proporciona el ID del pedido, redirigir a alguna otra página o mostrar un mensaje de error
    echo "Error en la página de detalles del pedido";
    exit; // Salir del script para evitar que se siga ejecutando
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del pedido</title>
    <link rel='stylesheet' href='./paginaDetallesPedido/detallePedido.css'/>
</head>
<body>
    <div class="cabecera">
        <div class="contIcono">
            <img class="icoCerrarSesion" src="imagenesPanel/iconoCerrarSesion.png" alt="Icono cierre de sesión"/>
            <a href="index.php?pag=pedidos"><img class="iconoCasa" title="Volver a página principal" src='imagenesPanel/iconoCasa4.png' alt="Icono de casa"/></a>
        </div>
        <div class="contLogo">
        <a href="index.php?pag=pedidos"><img class="logo" src="imagenesPanel/logoOrderMaster.png" alt="Imagen logo"/></a>
        </div>    
    </div>


        <!--<h2>Detalle del Pedido</h2>-->
        <h2>Información del pedido</h2>

        <table  class="tablaDetallesPedido">
            <tr>
                <th>Unidades</th>
                <th>Nombre</th>
                <th>Precio</th>
               <!-- <th>Estado</th>-->
            </tr>
        <?php
            $sum=0;
            while ($row = mysqli_fetch_assoc($result)) { //destacar pedidos no entregados
                echo "<tr>";
                echo "<td>" . $row['unidadesPlato'] . "</td>";
                echo "<td>" . $row['nombrePlato'] . "</td>";
                echo "<td>" . $row['precioPlato'] . " €</td>";
                echo "</tr>";
                $sum=$sum +  ($row['unidadesPlato'] * $row['precioPlato']);
            }
        ?>
        </table>       
       
        <?php
        mysqli_data_seek($result, 0);
        // Obtener el primer resultado para mostrar el nombre del cliente
        $row = mysqli_fetch_assoc($result);
           echo "<div class='detalles'>";
           echo "<p>Precio total = ". $sum ." €</p>"; 
           echo "<p>Nombre del cliente: ". $row['nombreCliente'] ."</p>";
           echo "<p>Estado del pedido: ". $row['estadoPedido'] ."</p>";
           echo "<p>Dirección: ". $row['direccion'] ."</p>"; //hacer que la direccion solo se muestre cuando el pedido es a domicilio    
           echo "<div>"; 
        ?>

        <!--<hr>-->


    </body>
</html>





