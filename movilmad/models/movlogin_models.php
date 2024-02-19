<?php
require_once("../db/db.php");

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


function inicio_sesion($email, $pass){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT * FROM rclientes where email=:email and idcliente=:pass");
        $stmt2->bindParam(':pass', $pass);
        $stmt2->bindParam(':email', $email);
        $stmt2->execute();
        $arrayBool=$stmt2->fetchAll(PDO::FETCH_ASSOC);
        return $arrayBool;
    }catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}

function obtenerNombre($passw){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT nombre, apellido FROM rclientes where idcliente=:passw");
        $stmt2->bindParam(':passw', $passw);
        $stmt2->execute();
        $nombre=$stmt2->fetchAll(PDO::FETCH_ASSOC);
        return $nombre[0]['nombre'].' '.$nombre[0]['apellido'];
    }catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}

?>