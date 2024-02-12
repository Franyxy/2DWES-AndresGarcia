<?php
try {
    // Incluye el archivo donde defines las constantes de la base de datos
    require_once("movconfig.php");

    // Crear una nueva conexión PDO
    $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    
    // Establecer el modo de error a excepción para PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Si ocurre un error, capturarlo y mostrar el mensaje de error
    echo "Error de conexión: " . $e->getMessage();
}
?>
