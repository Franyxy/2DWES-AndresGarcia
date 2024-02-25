<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'adm1n');
define('DB_DATABASE', 'movilmad');

try {
    // Crear una nueva conexión PDO
    $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    
    // Establecer el modo de error a excepción para PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Si ocurre un error, capturarlo y mostrar el mensaje de error
    echo "Error de conexión: " . $e->getMessage();
    exit(); // Salir del script
}
?>
