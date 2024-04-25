<?php
session_start();

if(isset($_SESSION['cart'])) {
    $cartItemCount = count($_SESSION['cart']);
    echo $cartItemCount;
} else {
    echo 0;
}
?>