<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Producto</title>
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body>
    <!--
        Alta Producto 
    -->
    <nav>
        <ul>
            <li><a href="comaltacat.php">Alta Categoría</a></li>
            <li><a href="comaltapro.php">Alta de Productos</a></li>
            <li><a href="comaltaalm.php">Alta de Almacenes</a></li>
            <li><a href="comaprpro.php">Aprovisionar Productos</a></li>
            <li><a href="comconstock.php">Consulta de Stock</a></li>
            <li><a href="comconsalm.php">Consulta de Almacenes</a></li>
            <li><a href="comconscom.php">Consulta de Compras</a></li>
            <li><a href="comaltacli.php">Alta de Clientes</a></li>
            <li><a href="compro.php">Compra de Productos</a></li>
        </ul>
    </nav>
    <fieldset>
    <legend>Alta Producto</legend>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nom_pro"> Nombre Producto</label>    
        <input type="text" name="nom_pro" id="nom_pro" required><br><br>
        <label for="precio"> Precio </label>    
        <input type="text" name="precio" id="precio" required><br><br>   
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "comprasweb";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt1 = $conn->prepare("SELECT ID_CATEGORIA,NOMBRE from categoria;");
            $stmt1->execute();
            $arrayCat=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            
            echo '<label for="nom_cat">Elige una categoria </label>';
            echo '<select name="nom_cat" id="nom_cat">';
            foreach ($arrayCat as $categoria) {
                $nombre = $categoria['NOMBRE'];
                $cod = $categoria['ID_CATEGORIA'];
                echo '<option value='.$cod.'>'.$nombre.'</option>';
            }
            echo '</select><br><br>';
        ?>
        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            include('funciones.php');
            try {

                // Sentencia sql para saber cuantas categorias hay, nos lo muestra en una array
                $stmt2 = $conn->prepare("SELECT MAX(ID_PRODUCTO) from producto;");
                $stmt2->execute();
                $CodMax=$stmt2->fetchColumn();
                //Condición if la cuál nos ayudará a obtener un código que se autoincremente
                if($CodMax==null){
                    $cod="P0001";

                }else{
                    $codStr=substr($CodMax,-4);
                    $codInt=$codStr+1;
                    $cod="P".str_pad($codInt,4,'0',STR_PAD_LEFT);

                }

                $nom_pro=test_input($_POST['nom_pro']);
                $precio=test_input($_POST['precio']);
                $id_cat=test_input($_POST['nom_cat']);

                $stmt2 = $conn->prepare("INSERT INTO producto (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) VALUES (:cod,:nom_pro,:precio,:id_cat);");
                $stmt2->bindParam(':cod', $cod);
                $stmt2->bindParam(':nom_pro', $nom_pro);
                $stmt2->bindParam(':precio', $precio);
                $stmt2->bindParam(':id_cat', $id_cat);
                $stmt2->execute();


                echo "Se han introducido los datos correctamente";
                }
            catch(PDOException $e)
                {
                echo "Error: " . $e->getMessage();
                }
            $conn = null;
        }

    ?>
</body>
</html>