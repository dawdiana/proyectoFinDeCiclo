<?php


    $query = "SELECT
     pedido.idPedido, 
     CONCAT(cliente.nombre, ' ', cliente.apellido1, ' ', cliente.apellido2) AS nombreCliente,
     pedido.precioPedido,
     pedido.estadoPedido
    FROM pedido INNER JOIN cliente ON pedido.fk_idCliente = cliente.idCliente";


    $result = mysqli_query($db, $query);

    // Verificar si hubo un error en la consulta
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($db));
        
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de pedidos</title>
    <link rel='stylesheet' href='listaPedidos.css'/>
</head>
<body>
    <div class="cabecera">
        <img class="logo" src="imagenesPanel/logoOrderMaster.png" alt="Imagen logo"/>
    </div>

    <div class="cuerpo">
        <h2>Lista de pedidos</h2>

        <table  class="tablaPedidos">
            <tr>
                <th>Nº de pedido</th>
                <th>Nombre cliente</th>
                <th>Estado</th>
                <th>Importe en €</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) { //destacar pedidos no entregados
                echo "<tr>";
                echo "<td>" . $row['idPedido'] . "</td>";
                echo "<td>" . $row['nombreCliente'] . "</td>";
                echo "<td>";
                echo "<form action='cambiarEstado.php' method='POST'>";
                echo "<input type='hidden' name='idPedido' value='" . $row['idPedido'] . "'>";
                echo "<select name='nuevoEstado'>";
                echo "<option value='En Proceso'>En Proceso</option>";
                echo "<option value='Enviado'>Enviado</option>";
                echo "<option value='Entregado'>Entregado</option>";
                echo "</select>";
                echo "<br><input type='submit' value='Actualizar'>";
                echo "</form>";
                echo "<td>" . $row['precioPedido'] . "€</td>";
                echo "<td><a href='detallePedido.php?id=" . $row['idPedido'] . "' title='Detalles de pedido'><img class='iconoPedido' src='imagenesPanel/iconoVerMas.png' alt='Icono pedido'></a></td>";
                echo "</tr>";
                 }
            ?>
            
        </table>
    </div>
</body>
</html>

