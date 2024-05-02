<?php

if (isset($_GET['id'])) {
    // Obtener el ID del pedido de la URL
    $idPedido = $_GET['id'];

    // Aquí deberías consultar la base de datos para obtener la información del pedido con el ID proporcionado
    // Supongamos que aquí obtienes la información del pedido correspondiente
    $query = "SELECT p.idPedido, p.fechaPedido, c.nombre AS nombreCliente
              FROM pedido p INNER JOIN cliente c ON p.idCliente = c.idCliente
              WHERE p.idPedido = '$idPedido'";
    
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

        <table  class="tablaPedidos">
            <tr>
                <th>unidades del Pedido</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Precio Total</th>
                <th>Estado</th>
            </tr>
        <?php
            while ($row = mysqli_fetch_assoc($result)) { //destacar pedidos no entregados
                echo "<tr>";
                echo "<td>" . $row['unidadesPlato'] . "</td>";
                echo "<td>" . $row['nombrePlato'] . "</td>";
                echo "<td>" . $row['precioPlato'] . "</td>";
                echo "<td>" . $row['precioLinea'] . "</td>";
                echo "<td>" . $row['estadoEnvio'] . "€</td>";
                echo "</tr>";
                 }
            ?>
        </table>
</body>
</html>





