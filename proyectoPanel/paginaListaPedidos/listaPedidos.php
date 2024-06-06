<?php

    $query = "SELECT
     pedido.idPedido, 
     CONCAT(cliente.nombre, ' ', cliente.apellido1, ' ', cliente.apellido2) AS nombreCliente,
     pedido.precioPedido, pedido.estadoPedido, pedido.tipoEntrega
    FROM pedido INNER JOIN cliente ON pedido.fk_idCliente = cliente.idCliente order by pedido.fechaPedido desc";


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
    
    <!--ESTILO PANTALLAS PEQUEÑAS (MÓVILES) -->
    <link rel='stylesheet' href='./paginaListaPedidos/estilos/listaPedidosMovil.css' media='(max-width: 540px)'/>
    <!--ESTILO PANTALLAS MEDIANAS (TABLETS )-->
    <link rel='stylesheet' href='./paginaListaPedidos/estilos/listaPedidosTablet.css' media='(min-width: 541px) and (max-width: 720px)'/>
    <!--ESTILO PANTALLAS GRANDES (ORDENADORES) -->
    <link rel='stylesheet' href='./paginaListaPedidos/estilos/listaPedidos.css'/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>


<!-- CABECERA -->

    <div class="cabecera">

        <!-- CONTENEDOR ICONOS DE NAVEGACIÓN -->

        <div class="iconosNav">
                    <a href="index.php?pag=pedidos" id="visitado" title="Lista de pedidos">
                        <img class="icoLista" src="imagenesPanel/iconos/iconoVermas.png" alt="Icono lista"/>
                    </a>

                    <a href="index.php?pag=modificarcarta"  title="Información Menú">
                        <img class="icoCarta" src="imagenesPanel/iconos/iconoCarta.png" alt="Icono carta"/>
                    </a>

                    <a href="index.php?pag=logout"  title="Cerrar sesión">
                        <img class="icoCerrarSesion" src="./imagenesPanel/iconos/iconoCerrarSesion3.png" alt="Icono cierre de sesión"/>
                    </a>
        </div>

        
        <!-- CONTENEDOR LOGO PÁGINA -->

        <div class="contLogo">
            <a href="index.php?pag=pedidos"><img class="logo" src="imagenesPanel/iconos/logoOrderMaster.png" alt="Imagen logo"/></a>
        </div>   
            
        <!-- CONTENEDOR TÍTULO PÁGINA  -->

        <div class="contTitulo">
            <h2>Lista de pedidos</h2>
        </div>

    </div>


    <!-- CUERPO DE LA PÁGINA -->

    <div class="cuerpo">


        <!-- TABLA DE PEDIDOS -->

        <table  class="tablaPedidos">
            <tr>
                <th>Nº de pedido</th>
                <th>Nombre cliente</th>
                <th>Tipo de Entrega</th>
                <th>Estado</th>
                <th>Importe en €</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) { 
                echo "<tr class=". $row['estadoPedido'].">"; //Clase hecha para destacar pedidos entregados
                echo "<td>" . $row['idPedido'] . "</td>";
                echo "<td>" . $row['nombreCliente'] . "</td>";
                echo "<td>" . $row['tipoEntrega'] . "</td>";
                echo "<td>";
               
                echo "<select class='estados' name='nuevoEstado' data-idPedido='".$row['idPedido']."'>";
                    if ($row['tipoEntrega']==='domicilio') {
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
                            echo "<option value='Enviado' selected display='hired'>Enviado</option>";
                        }else{
                            echo "<option value='Enviado'>Enviado</option>";
                        }
                        
                        if($row['estadoPedido']=='Entregado'){
                            echo "<option value='Entregado' selected>Entregado</option>";
                        }else{
                            echo "<option value='Entregado'>Entregado</option>";
                        }
                    } else {
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
                        
                        if($row['estadoPedido']=='Entregado'){
                            echo "<option value='Entregado' selected>Entregado</option>";
                        }else{
                            echo "<option value='Entregado'>Entregado</option>";
                        }    
                    }



                echo "</select>";
                echo "<div class='resultadoAjax' id='resultadoAjax_".$row['idPedido']."'></div>";
               
                echo "<td>" . $row['precioPedido'] . " €</td>";
                echo "<td><a href='index.php?pag=detallepedido&id=" . $row['idPedido'] . "' title='Detalles de pedido'><img class='iconoPedido' src='imagenesPanel/iconos/iconoVerDetalles.png' alt='Icono detalles de pedido'></a></td>";
                echo "</tr>";
                 }
            ?>
            
        </table>


         <!--PIE DE PÁGINA-->

        <div class="footer">
        <div>

    </div>

            
    <!-- SCRIPT PARA HACER LLAMADA AJAX PARA USAR LA FUNCIÓN DE CAMBIAR ESTADO DE PEDIDO -->

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

