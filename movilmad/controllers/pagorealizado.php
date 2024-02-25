<?php
	require_once("../models/global.php");
	test_inicio();
    require_once("../models/postpago_models.php");
    require_once("../db/db.php");
?>
<html> 
<body> 
<?php
	include '../models/apiRedsys.php';

	$miObj = new RedsysAPI;

		if (!empty( $_GET ) ) {
            try {
                global $conn;
                $conn->beginTransaction();
            
                $version = $_GET["Ds_SignatureVersion"];
                $datos = $_GET["Ds_MerchantParameters"];
                $signatureRecibida = $_GET["Ds_Signature"];
                    
                $decodec = $miObj->decodeMerchantParameters($datos);
                $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
                $firma = $miObj->createMerchantSignatureNotif($kc,$datos);
            
                if ($firma === $signatureRecibida){
                    insertar_datos();
                    echo "Pago Realizado<br>";
                    echo "Numero de Transaccion: ".$_SESSION['transaccion_orderNumber']."<br>";
                }
                ?>
                <a href="../views/movwelcome.php" class="btn btn-warning">Menu</a>
                <?php
                $conn->commit();
                
            } catch (Exception $e) {
                $conn->rollBack();
                echo "Transaction failed: " . $e->getMessage();
            }
            $conn = null;
		}
		else{
			die("No se recibió respuesta");
		}

?>
</body> 
</html>

