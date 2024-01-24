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
            $password = "adm1n";
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
        try{
            $customerNumber = $_SESSION['nombre'];
            $fecha = date('Y-m-d');
            $checkNumber = 'AA000000';
            $stmt1 = $conn->prepare("INSERT INTO payments (customerNumber, checkNumber, paymentDate, amount) VALUES(:customerNumber, :checkNumber, :paymentDate, :amount) ; ");
            $stmt1->bindParam(':customerNumber', $customerNumber);
            $stmt1->bindParam(':checkNumber', $checkNumber);
            $stmt1->bindParam(':paymentDate', $fecha);
            $stmt1->bindParam(':amount', $amount);
            $stmt1->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
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
?>