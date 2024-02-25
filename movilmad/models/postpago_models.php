<?php
function insertar_datos(){
    global $conn;
    try{
        $stmt2 = $conn->prepare("UPDATE ralquileres SET fecha_devolucion = :fecha_devolucion, preciototal = :preciototal, fechahorapago = :fechaAhora WHERE matricula = :matricula AND idcliente = :idcliente AND fecha_devolucion IS NULL");
        
        $stmt2->bindParam(':matricula', $_SESSION['matricula']);
        $stmt2->bindParam(':idcliente', $_SESSION['identificador']);
        $stmt2->bindParam(':fecha_devolucion', $_SESSION['transaccion_fecha']);
        $stmt2->bindParam(':preciototal', $_SESSION['transaccion_amount']);
        
        $fecha = date('Y-m-d H:i:s');
        $stmt2->bindParam(':fechaAhora', $fecha);
        
        $stmt2->execute();

    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
}
?>
