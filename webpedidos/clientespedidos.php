<?php
include('funciones.php');

try {
    $conn = conection();
    $id_cliente = $_POST['id_cliente'];

    if (!empty($id_cliente)) {
        $query = "SELECT orderNumber, orderDate, status FROM orders WHERE customerNumber = :id_cliente";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();

        $json = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $json[] = array(
                'orderNumber' => $row['orderNumber'],
                'orderDate' => $row['orderDate'],
                'status' => $row['status']
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