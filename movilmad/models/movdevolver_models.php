<?php
require_once("../db/db.php");

function obtenerVehiculosDevolver(){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT rvehiculos.marca, rvehiculos.modelo, rvehiculos.matricula FROM rvehiculos, ralquileres WHERE rvehiculos.matricula = ralquileres.matricula AND idcliente = :idcliente AND ralquileres.fecha_devolucion IS NULL;");
        $stmt2->bindParam(':idcliente', $_SESSION['identificador']);

        $stmt2->execute();
        $arrayVehiculosDevolver = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        return $arrayVehiculosDevolver;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}

function obtenerFecha($cocheDevolver_matricula){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT fecha_alquiler FROM ralquileres WHERE idcliente = :idcliente AND ralquileres.fecha_devolucion IS NULL AND matricula = :matricula;");
        $stmt2->bindParam(':idcliente', $_SESSION['identificador']);
        $stmt2->bindParam(':matricula', $cocheDevolver_matricula);
        $stmt2->execute();
        $fecha = $stmt2->fetchAll(PDO::FETCH_COLUMN);

        return $fecha[0];
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}

function obtenerMinutos($fecha){
    global $conn;
    try {
        // Consulta SQL con TIMESTAMPDIFF para obtener la diferencia en minutos
        $sql = "SELECT TIMESTAMPDIFF(MINUTE, :fecha_dada, NOW()) AS diferencia_minutos";
    
        // Preparar la consulta
        $stmt = $conn->prepare($sql);
    
        // Asociar el parámetro de fecha dada
        $stmt->bindParam(':fecha_dada', $fecha);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado de la consulta
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $resultado['diferencia_minutos'];
    
    } catch(PDOException $e) {
        // Manejar cualquier error de conexión
        echo "Error de conexión: " . $e->getMessage();
    }
}

function obtenerTarifa($cocheDevolver_matricula){
    global $conn;
    try{
        $stmt2 = $conn->prepare("SELECT preciobase FROM rvehiculos WHERE matricula = :matricula;");
        $stmt2->bindParam(':matricula', $cocheDevolver_matricula);
        $stmt2->execute();
        $precio = $stmt2->fetchAll(PDO::FETCH_COLUMN);

        return $precio[0];
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
    $conn = null;
}

function convertirPrecio($precio) {
    $precioCentavos = $precio * 100;
    $precioString = str_replace('.', '', strval($precioCentavos));
    if (strlen($precioString) == 2) {
        $precioString .= '00'; // Ejemplo: 24.4 -> 2440
    } elseif (strlen($precioString) == 3) {
        $precioString .= '0'; // Ejemplo: 23.45 -> 2345
    } elseif (strlen($precioString) < 2) {
        $precioString = '00'; // Para casos como 0.1
    }
    return $precioString;
}


function generarCodigoAleatorio() {
    $letra1 = chr(rand(65, 90));
    $letra2 = chr(rand(65, 90));
    $numero = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $codigo = $letra1 . $letra2 . $numero;
    return $codigo;
}


function pasarela($amount, $orderNumber){

    // Se incluye la librería
    include 'apiRedsys.php';
    // Se crea Objeto
    $miObj = new RedsysAPI;
    // Valores de entrada que no hemos cambiado para ningún ejemplo
    $fuc="999008881";
    $terminal="1";
    $moneda="978";
    $trans="0";
    $urlOK="http://localhost/movilmad/controllers/pagorealizado.php";
    $urlKO="http://localhost/movilmad/controllers/pagocancelado.php";

    // Se Rellenan los campos
    $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
    $miObj->setParameter("DS_MERCHANT_ORDER",$orderNumber);
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
    $miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
    $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
    $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$urlOK);
    $miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);
    $miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);

    //Datos de configuración
    $version="HMAC_SHA256_V1";
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
    // Se generan los parámetros de la petición
    $params = $miObj->createMerchantParameters();
    $signature = $miObj->createMerchantSignature($kc);
    echo '<form id="frm" name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">';
    echo '<input type="text" name="Ds_SignatureVersion" value="'.$version.'" hidden/><br>';
    echo '<input type="text" name="Ds_MerchantParameters" value="'.$params.'" hidden/><br>';
    echo '<input type="text" name="Ds_Signature" value="'.$signature.'" hidden/><br>';
    echo '<input type="submit" value="Acceder al Pago" name="devolver" class="btn btn-warning disabled">';
    echo '</form>';   
}



?>
