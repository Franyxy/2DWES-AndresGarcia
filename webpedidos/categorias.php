<?php
include('funciones.php');
$conn = conection();
$cat = $_POST['cat'];

if (!empty($cat)) {
    $query = "SELECT productName, productCode, MSRP FROM `products` WHERE productLine = :cat AND quantityInStock > 0";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cat', $cat, PDO::PARAM_STR);
    $stmt->execute();

    $json = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $json[] = array(
            'productName' => $row['productName'],
            'productCode' => $row['productCode'],
            'precio' => $row['MSRP']
        );
    }

    if (!empty($json)) {
        echo json_encode($json);
    } else {
        echo json_encode(array("error" => "No hay resultados"));
    }
    exit;
}
?>
