<?php

// Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
// con la Base de Datos

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


function inicio_sesion($pass,$nombre){

	global $conn;

	try{
		$stmt2 = $conn->prepare("SELECT * FROM customers where customerNumber=:nombre and contactLastName=:pass");
		$stmt2->bindParam(':pass', $pass);
		$stmt2->bindParam(':nombre', $nombre);
		$stmt2->execute();
		$arrayBool=$stmt2->FetchAll(PDO::FETCH_ASSOC);
		return $arrayBool;
	}catch (PDOException $ex) {
		$ex->getMessage();
		return null;
	}
	$conn = null;
}
?>