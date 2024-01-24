<?php
include('funciones.php');
try{
    $conn = conection();
    $cat = $_POST['cat'];
    if (!empty($cat)) {
        $query = "SELECT productName, quantityInStock FROM products WHERE productLine = :cat";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cat', $cat);
        $stmt->execute();

        $json = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $json[] = array(
                'Nombre' => $row['productName'],
                'Unidades' => $row['quantityInStock']
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
