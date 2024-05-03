<?php


    $query = "SELECT
     pedido.idPedido, 
     CONCAT(cliente.nombre, ' ', cliente.apellido1, ' ', cliente.apellido2) AS nombreCliente,
     pedido.precioPedido, pedido.estadoPedido, pedido.tipoEntrega
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                <th>Tipo de Entrega</th>
                <th>Estado</th>
                <th>Importe en €</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) { //destacar pedidos no entregados
                echo "<tr>";
                echo "<td>" . $row['idPedido'] . "</td>";
                echo "<td>" . $row['nombreCliente'] . "</td>";
                echo "<td>" . $row['tipoEntrega'] . "</td>";
                echo "<td>";
               
                echo "<select class='estados' name='nuevoEstado' data-idPedido='".$row['idPedido']."'>";

                if($row['estadoPedido']=='Pendiente'){
                    echo "<option value='Pendiente' selected>Pendiente</option>";
                }else{
                    echo "<option value='Pendiente'>Pendiente</option>";
                }
                
                if($row['estadoPedido']=='En proceso'){
                    echo "<option value='En proceso' selected>En Proceso</option>";
                }else{
                    echo "<option value='En proceso'>En Proceso</option>";
                }

                if($row['estadoPedido']=='Enviado'){
                    echo "<option value='Enviado' selected>Enviado</option>";
                }else{
                    echo "<option value='Enviado'>Enviado</option>";
                }
                
                if($row['estadoPedido']=='Entregado'){
                    echo "<option value='Entregado' selected>Entregado</option>";
                }else{
                    echo "<option value='Entregado'>Entregado</option>";
                }

                echo "</select>";
                echo "<div class='resultadoAjax' id='resultadoAjax_".$row['idPedido']."'></div>";
               
                echo "<td>" . $row['precioPedido'] . "€</td>";
                echo "<td><a href='index.php?pag=detallepedido&id=" . $row['idPedido'] . "' title='Detalles de pedido'><img class='iconoPedido' src='imagenesPanel/iconoVerMas.png' alt='Icono pedido'></a></td>";
                echo "</tr>";
                 }
            ?>
            
        </table>
    </div>
    <script>
        $(document).ready(function() {
    
            $("select.estados").on( "change", function() {
                var idPedido = $(this).attr('data-idPedido');
                var nuevoEstado = $(this).val();

                $.ajax({
                    method: "POST",
                    url: "cambiarEstado.php",
                    dataType: "json",
                    data: { idPedido: idPedido, estadoPedido: nuevoEstado }
                }).done(function( datosDevueltosAjax ) {
                    $(".resultadoAjax").html('');
                    $("#resultadoAjax_"+idPedido).html(datosDevueltosAjax.mensaje);
                });

            });


        });
    </script>
</body>
</html>

