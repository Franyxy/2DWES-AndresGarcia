<html> 
<body> 
<?php
    session_start();
    if(!isset($_SESSION['nombre'])){
        header('location: cierresesion.php');
    }
    include 'funciones.php';
	include 'apiRedsys.php';

	$miObj = new RedsysAPI;

		if (!empty( $_GET ) ) {
            try {
                $conn = conection();
                $conn->beginTransaction();
            
                $version = $_GET["Ds_SignatureVersion"];
                $datos = $_GET["Ds_MerchantParameters"];
                $signatureRecibida = $_GET["Ds_Signature"];
                    
                $decodec = $miObj->decodeMerchantParameters($datos);
                $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
                $firma = $miObj->createMerchantSignatureNotif($kc,$datos);
            
                if ($firma === $signatureRecibida){
                    $productos_seleccionados = $_SESSION['productos_comprados'];
                    $orderNumber = $_SESSION['id_pedido'];
                    post_pago($conn, $orderNumber, $productos_seleccionados);
                    echo "Pedido Realizado<br>";
                    echo "Numero de Pedido: ".$orderNumber."<br>";

                }
                ?>
                <a href="pe_altaped.php">Volver al inicio</a>
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

