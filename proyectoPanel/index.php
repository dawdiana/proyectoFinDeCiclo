<?php
// Report simple running errors
error_reporting(E_ERROR | E_PARSE);


header('Content-Type: text/html; charset=utf-8');
session_start(); // Iniciamos sesión 

//Conexión a la BD
$db = mysqli_connect('localhost', 'root', '', 'proyectopfc') or die('Fail');
mysqli_set_charset($db, "utf8");



if(empty($_GET['pag'])){
    
    include ("login.php"); //luego cambiar a php

}elseif($_GET['pag']=='pedidos'){


    if(compruebaCredenciales($_SESSION['user'], $_SESSION['pass'])){
        include ("listaPedidos.php");
    }else{
        header('Location: index.php'); //lo envio al login
    }
    

}elseif($_GET['pag']=='detallepedido'){

    if(compruebaCredenciales($_SESSION['user'], $_SESSION['pass'])){
        include ("detallePedido.php");
    }else{
        header('Location: index.php'); //lo envio al login
    }

    

}


mysqli_close($db);



function compruebaCredenciales($usuario,$pass){
    global $db;
    $query="SELECT * FROM restaurante WHERE usuario='$usuario' AND contrasena='$pass'";
    $query_result = mysqli_query($db, $query) or die('Query error');
    if (mysqli_num_rows($query_result) > 0) {
        return true;
    }else{
        return false;
    }

}
?>