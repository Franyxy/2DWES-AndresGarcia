<?php
require_once("../db/db.php");

function mostrarDatos() {
    echo "<B>Bienvenido/a:</B> " . $_SESSION['nombre'] . "<BR><BR>";
    echo "<B>Identificador Cliente: </B>" . $_SESSION['identificador'] . "<BR><BR>";
    echo "<B>Vehiculos disponibles: </B>" . date('d/m/y h:i:s') . "<BR><BR>";
}

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



// Esta funcion agrega al carrito el vehiculo seleccionado
function agregar_carrito($matricula){
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    if (count($_SESSION['carrito']) >= 3) {
        echo "No puedes agregar más vehículos al carrito. El carrito ya está lleno.";
    } else {
        // Verificar si el vehículo ya está en el carrito
        if (!in_array($matricula, $_SESSION['carrito'])) {
            // Agregar la matrícula del vehículo al carrito
            $_SESSION['carrito'][] = $matricula;
            echo "Vehículo agregado al carrito.";
        } else {
            echo "Este vehículo ya está en el carrito.";
        }
    }
}


// Funcion para vaciar el carrito
function vaciar_carrito(){
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        unset($_SESSION['carrito']);
        echo "El carrito ha sido vaciado.";
    } else {
        echo "El carrito ya está vacío.";
    }
}

// Funcion para obtener la marca del vehiculo con la matricula
function obtener_marca($matricula){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT marca FROM rvehiculos WHERE matricula = :matricula;");
        $stmt2->bindParam(':matricula', $matricula);
        $stmt2->execute();
        $marca = $stmt2->fetchAll(PDO::FETCH_COLUMN);
        return $marca[0];
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}

// Funcion para alquilar un vehiculo con la matricula
function alquilar_vehiculo($matricula){
    
}

//Funcion para comprobar si puede reserar, por tener 3 vehiculos ya alquilados
function poder_alquilar(){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT count(*) FROM ralquileres WHERE fecha_devolucion IS NULL and idcliente = :idcliente;");
        $stmt2->bindParam(':idcliente', $_SESSION['identificador']);
        $stmt2->execute();
        $bool = $stmt2->fetchAll(PDO::FETCH_COLUMN);
        echo $bool[0];
        return $bool[0];
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}
?>
