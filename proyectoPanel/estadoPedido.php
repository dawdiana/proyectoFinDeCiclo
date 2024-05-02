<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPedido = $_POST['idPedido'];
    $nuevoEstado = $_POST['nuevoEstado'];

    // Actualizar el estado del pedido en la base de datos
    $query = "UPDATE pedido SET estado = '$nuevoEstado' WHERE idPedido = '$idPedido'";
    mysqli_query($db, $query);
}

    header("Location: listaPedidos.php");
    exit;

?>