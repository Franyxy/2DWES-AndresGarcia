<?php
    session_start();
    include('funciones.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Inicio</title>
    <link rel="stylesheet" type="text/css" href="./css/inicio.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<div class="container">
    <nav>
        <ul class="nav">
        <li><a href="pe_altaped.php">Compra Productos</a></li>
        <li class="active"><a href=" pe_consped.php">Consulta Pedidos</a></li>
        <li><a href="pe_consprodstock.php">Consulta Stock</a></li>
        <li><a href="pe_constock.php">Consulta Stock | Linea Producto</a></li>
        <li><a href="pe_topprod.php">Productos Vendidos</a></li>
        <li><a href="pe_conspago.php">Pagos Realizados</a></li>
        <li><a href="carrito.php"><img src="img/carrito.png"></a></li>
        </ul>
    </nav>
</div>
    <fieldset>
        <legend>Compra Producto</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
            $conn = conection();
            $stmt1 = $conn->prepare("SELECT productLine from productlines;");
            $stmt1->execute();
            $arrayProd=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            
            echo '<label for="cat">Elige una categoria </label>';
            echo '<select name="cat" id="cat"><br>';
            foreach ($arrayProd as $cat) {
                $categoria = $cat['productLine'];
                echo '<option value='.$categoria.'>'.$categoria.'</option>';
            }
            echo '</select><br><br>';
        ?> 
        
        <label for="prod" id="prodLabel" style="display: none;">Elige un producto </label>
        <select name="prod" id="prod" style="display: none;"></select><br><br>

        <label for="unidades" id="unidadesLabel" style="display: none;">Unidades </label>
        <input type="text" name="unidades" id="unidades" required style="display: none;"><br><br>
        <input type="submit" id="añadircarrito" style="display: none;" value="Añadir Carrito">
    </form>
    </fieldset>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            try {
                if (!isset($_SESSION["carrito"])) {
                    $_SESSION["carrito"] = array();
                }
                $unidades=test_input($_POST['unidades']);
                if(!ctype_digit($unidades)){
                    throw new Exception ('Número de unidades introducido NO válido.');
                }

                $id_prod=test_input($_POST['prod']);
                $VintTotalProd = calcularTotalStock($conn, $id_prod);

                if($VintTotalProd<$unidades){
                    throw new Exception ('No hay unidades suficientes');
                }else{
                    echo "Se ha añadido al carrito";
                    if (array_key_exists($id_prod, $_SESSION["carrito"])) {
                        $_SESSION["carrito"][$id_prod]["cantidad"] += $unidades;
                    } else {
                        $_SESSION["carrito"][$id_prod] = array(
                            "cantidad" => $unidades,
                        );
                    }
                }
                
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="categorias.js"></script>
</body>
</html>