<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Producto</title>
</head>
<body>
    <!--
        Alta Producto 
    -->
    <h1>Alta Producto</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nom_pro"> Nombre Producto</label>    
        <input type="text" name="nom_pro" id="nom_pro"><br><br>
        <label for="precio"> Precio </label>    
        <input type="text" name="precio" id="precio"><br><br>   
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
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {

                // Sentencia sql para saber cuantas categorias hay, nos lo muestra en una array
                $stmt2 = $conn->prepare("SELECT NOMBRE from producto;");
                $stmt2->execute();
                $NumProd=$stmt2->FetchAll(PDO::FETCH_COLUMN);
                //Condición if la cuál nos ayudará a obtener un código que se autoincremente
                if(sizeof($NumProd)==0){
                    $cod="P0001";
                }else{
                    $aux=str_pad(sizeof($NumProd)+1, 4, "0", STR_PAD_LEFT);
                    $cod="P".$aux;
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

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
</body>
</body>
</html>