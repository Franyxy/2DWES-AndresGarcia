<?php
require_once("../db/db.php");

function obtenerAlquileres($fecha1, $fecha2){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT rvehiculos.marca, rvehiculos.modelo, rvehiculos.matricula, ralquileres.fecha_alquiler FROM rvehiculos INNER JOIN ralquileres ON rvehiculos.matricula = ralquileres.matricula WHERE ralquileres.idcliente = :idcliente AND ralquileres.fecha_alquiler >= :fecha1 
        AND ralquileres.fecha_alquiler <= :fecha2;");
        $stmt2->bindParam(':idcliente', $_SESSION['identificador']);
        $stmt2->bindParam(':fecha1', $fecha1);
        $stmt2->bindParam(':fecha2', $fecha2);
        $stmt2->execute();
        $arrayAlquiler = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        return $arrayAlquiler;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}

?>
