<?php
session_start();

if(isset($_SESSION['cart'])) {

    $sum=0;
    foreach ($_SESSION['cart'] as $key => $value) {        
        $sum = $sum + intval($value['cantidad']);
    }    
    echo $sum;
} else {
    echo 0;
}
?>