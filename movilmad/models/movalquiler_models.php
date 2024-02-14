<?php
require_once("../db/db.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function obtenerVehiculos(){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT marca, modelo, matricula FROM rvehiculos WHERE disponible = 'S';");
        $stmt2->execute();
        $arrayVehiculos = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        return $arrayVehiculos;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}
?>
