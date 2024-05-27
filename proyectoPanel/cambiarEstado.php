<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPedido = $_POST['idPedido'];
    $nuevoEstado = $_POST['estadoPedido'];

    $db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
    mysqli_set_charset($db, "utf8");


    // Actualizar el estado del pedido en la base de datos
    $query = "UPDATE pedido SET estadoPedido = '$nuevoEstado' WHERE idPedido = '$idPedido'";
    if(mysqli_query($db, $query)){
        $salida['suceso']=true;
        $salida['mensaje']='Cambio realizado';
    }else{
        $salida['suceso']=false;
        $salida['mensaje']='Cambio NO realizado';
    }

    if($nuevoEstado!="Pendiente") {

        $para = 'dshevchenko22@fpcoruna.afundacion.org';
        $titulo = 'El estado de su envío';
        $mensaje   = 'Le estamos contactando para avisarle de que su envío está'.$nuevoEstado;
        $cabeceras = 'From: dshevchenko22@fpcoruna.afundacion.org' . "\r\n" .
                     'Reply-To: dshevchenko22@fpcoruna.afundacion.org' . "\r\n" .
                     'X-Mailer: PHP/' . phpversion();

        mail($para, $titulo, $mensaje, $cabeceras);

    }

    echo json_encode($salida);

}


?>