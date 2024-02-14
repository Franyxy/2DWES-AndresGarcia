<?php
    if (!isset($_SESSION['email'])) {
        header('Location: ./movlogin.php');
        exit();
    }
    if(isset($_POST['agregar'])) {
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }
            if (count($_SESSION['carrito']) >= 3) {
                echo "No puedes agregar más vehículos al carrito. El carrito ya está lleno.";
            } else {
                // Verificar si el vehículo ya está en el carrito
                if (!in_array($_POST['vehiculos'], $_SESSION['carrito'])) {
                    // Agregar la matrícula del vehículo al carrito
                    $_SESSION['carrito'][] = $_POST['vehiculos'];
                    echo "Vehículo agregado al carrito.";
                } else {
                    echo "Este vehículo ya está en el carrito.";
                }
            }
    }
    if(isset($_POST['vaciar'])) {
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            unset($_SESSION['carrito']);
            echo "El carrito ha sido vaciado.";
        } else {
            echo "El carrito ya está vacío.";
        }
    }
?>
