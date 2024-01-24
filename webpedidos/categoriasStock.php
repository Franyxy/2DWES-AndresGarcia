<?php
include('funciones.php');
try{
    $conn = conection();
    $prod_id = $_POST['selectedProduct'];
    if (!empty($prod_id)) {
        $query = "SELECT quantityInStock FROM products WHERE productCode = :prod_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':prod_id', $prod_id);
        $stmt->execute();

        $json = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $json[] = array(
                'Stock' => $row['quantityInStock']
            );
        }

        if (!empty($json)) {
            echo json_encode($json);
        } else {
            echo json_encode(array("error" => "No hay resultados"));
        }
        exit;
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}catch(Exception $e){
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
