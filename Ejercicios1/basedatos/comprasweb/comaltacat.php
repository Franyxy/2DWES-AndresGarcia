<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Categoría</title>
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body>
    <!--
        Alta Categoría 
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
    <legend>Alta Categoría</legend>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nom_cat"> Nombre Categoria</label>    
        <input type="text" name="nom_cat" id="nom_cat" required><br><br>
        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
    include('funciones.php');
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
    ?>
</body>
</body>
</html>