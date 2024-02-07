<?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function conection(){
        try{
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "pedidos";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function inicio_sesion($conn,$pass,$nombre){
        try{
            $stmt2 = $conn->prepare("SELECT * FROM customers where customerNumber=:nombre and contactLastName=:pass");
            $stmt2->bindParam(':pass', $pass);
            $stmt2->bindParam(':nombre', $nombre);
            $stmt2->execute();
            $arrayBool=$stmt2->FetchAll(PDO::FETCH_ASSOC);
            return $arrayBool;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function calcularTotalStock($conn, $id_prod){
        try{
            $stmtCantidadProd = $conn->prepare("SELECT quantityInStock as total from products Where productCode=:id_prod;");
            $stmtCantidadProd->bindParam(':id_prod', $id_prod);
            $stmtCantidadProd->execute();
            $ArrCantProd=$stmtCantidadProd->FetchAll(PDO::FETCH_ASSOC);
            $VintTotalProd=0;
            foreach($ArrCantProd as $x){
                $VintTotalProd=$VintTotalProd+$x['total'];
            }
        return $VintTotalProd;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function obtener_nombre($conn,$prod){
        try{
            $stmt1 = $conn->prepare("SELECT productName from products Where productCode = '$prod';");
            $stmt1->execute();
            $arrayProd=$stmt1->FetchAll(PDO::FETCH_COLUMN);
            return $arrayProd[0];
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function comprar_productos($conn,$id_prod,$unidades){
        try{
            $stmt1 = $conn->prepare("SELECT quantityInStock FROM products Where productCode = :id_prod; ");
            $stmt1->bindParam(':id_prod', $id_prod);
            $stmt1->execute();
            $stock = $stmt1->FetchAll(PDO::FETCH_COLUMN);
            $newStock = $stock[0] - $unidades;

            $stmt2 = $conn->prepare("UPDATE products SET quantityInStock =:newStock  WHERE productCode = :id_prod;");
            $stmt2->bindParam(':id_prod', $id_prod);
            $stmt2->bindParam(':newStock', $newStock);
            $stmt2->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function obtenerPrecio($conn,$id_prod){
        try{
            $stmt1 = $conn->prepare("SELECT MSRP FROM products Where productCode = :id_prod; ");
            $stmt1->bindParam(':id_prod', $id_prod);
            $stmt1->execute();
            $precio = $stmt1->FetchAll(PDO::FETCH_COLUMN);
            return $precio[0];
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    function obtener_orderNumber($conn){
        try{
            $stmt1 = $conn->prepare("SELECT MAX(orderNumber) FROM orders; ");
            $stmt1->execute();
            $orderNumber = $stmt1->FetchAll(PDO::FETCH_COLUMN);
            return $orderNumber[0]+1;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function añadir_order($conn,$orderNumber){
        try{
            $stmt1 = $conn->prepare("INSERT INTO orders (orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber) VALUES(:orderNumber, :orderDate, :requiredDate, NULL, 'In Process', NULL, :customerNumber) ; ");
            $id_sesion = $_SESSION['nombre'];
            $fecha = date('Y-m-d');
            $stmt1->bindParam(':orderNumber', $orderNumber);
            $stmt1->bindParam(':orderDate', $fecha);
            $stmt1->bindParam(':requiredDate', $fecha);
            $stmt1->bindParam(':customerNumber', $id_sesion);
            $stmt1->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function añadir_orderDetails($conn,$orderNumber,$cont,$prod_id,$unidad,$precioEach){
        try{
            $stmt1 = $conn->prepare("INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, PriceEach, orderLineNumber) VALUES(:orderNumber, :productCode, :quantityOrdered, :PriceEach, :orderLineNumber) ; ");
            $stmt1->bindParam(':orderNumber', $orderNumber);
            $stmt1->bindParam(':productCode', $prod_id);
            $stmt1->bindParam(':quantityOrdered', $unidad);
            $stmt1->bindParam(':PriceEach', $precioEach);
            $stmt1->bindParam(':orderLineNumber', $cont);
            $stmt1->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function añadir_payments($conn, $amount){
        try {
            $customerNumber = $_SESSION['nombre'];
            $fecha = date('Y-m-d');
            do {
                $checkNumber = generarCodigoAleatorio();
            } while (!comprobarcodigo($conn, $checkNumber));
    
            $stmt1 = $conn->prepare("INSERT INTO payments (customerNumber, checkNumber, paymentDate, amount) VALUES(:customerNumber, :checkNumber, :paymentDate, :amount)");
            $stmt1->bindParam(':customerNumber', $customerNumber);
            $stmt1->bindParam(':checkNumber', $checkNumber);
            $stmt1->bindParam(':paymentDate', $fecha);
            $stmt1->bindParam(':amount', $amount);
            $stmt1->execute();
    
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    function comprobarcodigo($conn, $checkNumber){
        try {
            $stmt1 = $conn->prepare("SELECT * FROM payments WHERE checkNumber = :checkNumber;");
            $stmt1->bindParam(':checkNumber', $checkNumber);
            $stmt1->execute();
            $ArrayCheckNumber = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            if (empty($ArrayCheckNumber)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return FALSE;
        }
    }
    
    function generarCodigoAleatorio() {
        $letra1 = chr(rand(65, 90));
        $letra2 = chr(rand(65, 90));
        $numero = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $codigo = $letra1 . $letra2 . $numero;
        return $codigo;
    }
    
    
    function prod_vendidos($conn, $fecha1, $fecha2){
        try{
            $stmt1 = $conn->prepare("SELECT products.productName, SUM(orderdetails.quantityOrdered) AS unidades_totales FROM orders JOIN orderdetails ON orders.orderNumber = orderdetails.orderNumber JOIN products ON orderdetails.productCode = products.productCode WHERE orders.orderDate BETWEEN :fechaInicio AND :fechaFin GROUP BY products.productName");
            $stmt1->bindParam(':fechaInicio', $fecha1);
            $stmt1->bindParam(':fechaFin', $fecha2);
            $stmt1->execute();
            $ArrayProd=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            return $ArrayProd;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }


    function imprimir_prodVendidos($ArrayProd){
        echo "<br><table>";
        echo "<tr><th>Producto</th><th>Unidades Vendidas</th></tr>";
        foreach($ArrayProd as $prod){
            $productName = $prod['productName'];
            $unidades = $prod['unidades_totales'];
            echo "<tr><td>$productName</td><td>$unidades</td></tr>";
        }
        echo "</table>";
    }

    function consultarCliente($conn){
        try{
            $stmt1 = $conn->prepare("SELECT customerNumber, customerName, contactLastName FROM customers;");
            $stmt1->execute();
            $ArrayClientes=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            return $ArrayClientes;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    
    function  imprimir_Cliente($arrayCliente){
        echo '<label for="cliente">Elige un cliente </label>';
            echo '<select name="cliente" id="cliente"><br>';
            foreach ($arrayCliente as $cliente) {
                $nombre = $cliente['customerName'];
                $apellido = $cliente['contactLastName'];
                $id_cliente = $cliente['customerNumber'];
                echo '<option value='.$id_cliente.'>'.$nombre." -> ".$id_cliente.'</option>';
            }
            echo '</select><br><br>';
    }

    function paymentsFechas($conn, $fecha1, $fecha2, $id_cliente){
        try{
            $stmt1 = $conn->prepare("SELECT *  FROM payments WHERE customerNumber = :id_cliente AND paymentDate BETWEEN :fecha1 and :fecha2;");
            $stmt1->bindParam(':fecha1', $fecha1);
            $stmt1->bindParam(':fecha2', $fecha2);
            $stmt1->bindParam(':id_cliente', $id_cliente);
            $stmt1->execute();
            $arrayPayments=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            return $arrayPayments;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function paymentsNOFechas($conn, $id_cliente){
        try{
            $stmt1 = $conn->prepare("SELECT *  FROM payments WHERE customerNumber = :id_cliente;");
            $stmt1->bindParam(':id_cliente', $id_cliente);
            $stmt1->execute();
            $arrayPayments=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            return $arrayPayments;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function imprimirPayments($arrayPayments){
        echo "<br><table>";
        echo "<tr><th>Check Number</th><th>Payment Date</th><th>Amount</th></tr>";
        foreach($arrayPayments as $pay){
            $checkNumber = $pay['checkNumber'];
            $paymentDate = $pay['paymentDate'];
            $amount = $pay['amount'];
            echo "<tr><td>$checkNumber</td><td>$paymentDate</td><td>$amount</td></tr>";
        }
        echo "</table>";
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

    function pasarela($orderNumber, $amount) {
        // Se incluye la librería
        include 'apiRedsys.php';
        // Se crea Objeto
        $miObj = new RedsysAPI;

        // Valores de entrada que no hemos cambiado para ningún ejemplo
        $fuc="999008881";
        $terminal="1";
        $moneda="978";
        $trans="0";
        $urlOK="http://192.168.206.211/webpedidos/pagorealizado.php";
        $urlKO="http://192.168.206.211/webpedidos/pagocancelado.php";
        $id=$orderNumber+1;
        $amount1=convertirPrecio($amount);  

        // Se Rellenan los campos
        $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount1);
        $miObj->setParameter("DS_MERCHANT_ORDER",$id);
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
        echo '<input type="submit" value="Acceder al Pago">';
        echo '</form>';   
    }

    function post_pago($conn, $orderNumber, $productos_seleccionados){

        $cont = 0;
        $amount = 0;
        foreach ($productos_seleccionados as $prod_id => $unidadesProd) {
            $cont += 1;
            $unidad = $unidadesProd["cantidad"];
            comprar_productos($conn,$prod_id,$unidad);
            unset($_SESSION['carrito'][$prod_id]);
            añadir_order($conn,$orderNumber);
            $precioEach = obtenerPrecio($conn,$prod_id);
            $amount += $precioEach*$unidad;
            añadir_orderDetails($conn,$orderNumber,$cont,$prod_id,$unidad,$precioEach);
        }
        añadir_payments($conn, $amount);
    }
?>
