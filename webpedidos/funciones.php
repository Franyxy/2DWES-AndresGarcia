<?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function conection(){
        $servername = "localhost";
        $username = "root";
        $password = "adm1n";
        $dbname = "pedidos";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    function inicio_sesion($conn,$pass,$nombre){
        $stmt2 = $conn->prepare("SELECT * FROM customers where customerNumber=:nombre and contactLastName=:pass");
        $stmt2->bindParam(':pass', $pass);
        $stmt2->bindParam(':nombre', $nombre);
        $stmt2->execute();
        $arrayBool=$stmt2->FetchAll(PDO::FETCH_ASSOC);
        return $arrayBool;
    }

    function calcularTotalStock($conn, $id_prod){
        $stmtCantidadProd = $conn->prepare("SELECT quantityInStock as total from products Where productCode=:id_prod;");
                $stmtCantidadProd->bindParam(':id_prod', $id_prod);
                $stmtCantidadProd->execute();
                $ArrCantProd=$stmtCantidadProd->FetchAll(PDO::FETCH_ASSOC);
                $VintTotalProd=0;
                foreach($ArrCantProd as $x){
                    $VintTotalProd=$VintTotalProd+$x['total'];
                }
        return $VintTotalProd;
    }

    function obtener_nombre($conn,$prod){
        $stmt1 = $conn->prepare("SELECT productName from products Where productCode = '$prod';");
        $stmt1->execute();
        $arrayProd=$stmt1->FetchAll(PDO::FETCH_COLUMN);
        return $arrayProd[0];
    }

    function comprar_productos($conn,$id_prod,$unidades){
        $stmt1 = $conn->prepare("SELECT quantityInStock FROM products Where productCode = :id_prod; ");
        $stmt1->bindParam(':id_prod', $id_prod);
        $stmt1->execute();
        $stock = $stmt1->FetchAll(PDO::FETCH_COLUMN);
        $newStock = $stock[0] - $unidades;

        $stmt2 = $conn->prepare("UPDATE products SET quantityInStock =:newStock  WHERE productCode = :id_prod;");
        $stmt2->bindParam(':id_prod', $id_prod);
        $stmt2->bindParam(':newStock', $newStock);
        $stmt2->execute();
    }
?>