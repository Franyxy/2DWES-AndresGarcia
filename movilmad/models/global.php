<?php
require_once("../db/db.php");

function mostrarDatos() {
    echo "<B>Bienvenido/a:</B> " . $_SESSION['nombre'] . "<BR><BR>";
    echo "<B>Identificador Cliente: </B>" . $_SESSION['identificador'] . "<BR><BR>";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function test_inicio(){
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location:./movlogin.php');
    }
}

?>