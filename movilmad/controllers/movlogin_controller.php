<?php
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("../models/movlogin_models.php");
    $email=test_input($_POST['email']);
    $passw=test_input($_POST['password']);
    $arrayBool = inicio_sesion($email,$passw);

    if(!$arrayBool){
        header("Location:../views/movlogin.php");
    }else{
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['identificador'] = $passw;
        $_SESSION['nombre'] = obtenerNombre($passw);
        header("Location:../views/movwelcome.php");
    }


?>