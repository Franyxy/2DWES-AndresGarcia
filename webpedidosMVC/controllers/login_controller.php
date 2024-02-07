<?php
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/login_models.php");
    $pass=test_input($_POST['pass']);
    $nombre=test_input($_POST['nombre']);

    $arrayBool = inicio_sesion($pass,$nombre);

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("views/login_view.php");
?>