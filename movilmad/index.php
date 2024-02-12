<?php
    session_start();
    if(!isset($_SESSION['nombre'])){
        header('Location:./views/movlogin.php');
    }else{
        header('Location:./views/movwelcome.php');
    }
?>

    