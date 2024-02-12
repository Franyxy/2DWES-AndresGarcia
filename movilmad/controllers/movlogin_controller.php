<?php
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("../models/movlogin_models.php");
    $email=test_input($_POST['email']);
    $passw=test_input($_POST['password']);

    $arrayBool = inicio_sesion($email,$passw);
    if(!$arrayBool){
        echo("El nombre de usuario o la contraseña no coinciden / No se ha registrado");
    }else{
        session_start();
        $_SESSION['nombre']=$email;
        header("Location:../views/movwelcome.php");
    }

?>