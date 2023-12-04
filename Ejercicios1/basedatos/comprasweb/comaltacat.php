<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Categoría</title>
</head>
<body>
    <!--
        Alta Categoría 
    -->
    <h1>Alta Categoría</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nom_cat"> Nombre Categoria</label>    
        <input type="text" name="nom_cat" id="nom_cat"><br><br>
        <input type="submit">
        <input type="reset">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "comprasweb";
            
            
            
            try {
                // Establecemos la conexion
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Sentencia sql para saber cuantas categorias hay, nos lo muestra en una array
                $stmt = $conn->prepare("SELECT MAX(ID_CATEGORIA) from categoria;");
                $stmt->execute();
                $CodMax=$stmt->fetchColumn();

                //Condición if la cuál nos ayudará a obtener un código que se autoincremente
                if($CodMax==null){
                    $cod="C-001";

                }else{
                    $codStr=substr($CodMax,-3);
                    $codInt=$codStr+1;
                    $cod="C-".str_pad($codInt,3,'0',STR_PAD_LEFT);

                }

                $nom_cat=test_input($_POST['nom_cat']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //sentencia sql para insertar el codigo calculado mas el nombre obtenido
                $stmt1 = $conn->prepare("INSERT INTO categoria (ID_CATEGORIA,NOMBRE) VALUES (:cod,:nom_cat);");
                $stmt1->bindParam(':cod', $cod);
                $stmt1->bindParam(':nom_cat', $nom_cat);
                $stmt1->execute();
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