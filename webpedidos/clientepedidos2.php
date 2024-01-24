<?php
include('funciones.php');

try {
    $conn = conection();
    $id_pedido = $_POST['id_order'];

    if (!empty($id_pedido)) {
        $query = "SELECT orderLineNumber, productName, quantityOrdered, priceEach FROM orderdetails, products WHERE orderdetails.productCode = products.productCode AND orderdetails.orderNumber = :id_pedido; ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_pedido', $id_pedido);
        $stmt->execute();

        $json = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $json[] = array(
                'orderLineNumber' => $row['orderLineNumber'],
                'productName' => $row['productName'],
                'quantityOrdered' => $row['quantityOrdered'],
                'priceEach' => $row['priceEach']
            );
        }
        if (!empty($json)) {
            echo json_encode($json);
        } else {
            echo json_encode(array("error" => "No hay resultados"));
        }
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>