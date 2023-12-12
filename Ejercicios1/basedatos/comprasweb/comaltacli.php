<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Clientes </title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <!--
        Alta Clientes 
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
        <legend>Alta Clientes</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nombre">Nombre</label>    
        <input type="text" name="nombre" id="nombre" required><br><br>
        <label for="apellido">Apellido</label>    
        <input type="text" name="apellido" id="apellido" required><br><br> 
        <label for="nif">NIF</label>    
        <input type="text" name="nif" id="nif" required><br><br> 
        <label for="cp">CP</label>    
        <input type="text" name="cp" id="cp"><br><br>
        <label for="ciudad">Ciudad</label>    
        <input type="text" name="ciudad" id="ciudad"><br><br> 
        <label for="direccion">Direccion</label>    
        <input type="text" name="direccion" id="direccion"><br><br> 
        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
        include('funciones.php');
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            try{
                $servername = "localhost";
                $username = "root";
                $password = "rootroot";
                $dbname = "comprasweb";
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                $nif=test_input($_POST['nif']);
                $nombre=test_input($_POST['nombre']);
                $apellido=test_input($_POST['apellido']);
                $cp=test_input($_POST['cp']);
                $ciudad=test_input($_POST['ciudad']);
                $direccion=test_input($_POST['direccion']);
                

                validarNIF($nif);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt1 = $conn->prepare("SELECT * FROM comprasweb.cliente where NIF=:nif;");
                $stmt1->bindParam(':nif', $nif);
                $stmt1->execute();
                $NIF=$stmt1->fetchColumn();
                if(!empty($NIF)){
                    throw new Exception ('El NIF introducido ya ha sido registrado');
                }
                $stmt2 = $conn->prepare("INSERT INTO cliente(NIF,NOMBRE,APELLIDO,CP,CIUDAD,DIRECCION) 
                                                    VALUES (:nif,:nombre,:apellido,:cp,:ciudad,:direccion); ");
                $stmt2->bindParam(':nif', $nif);
                $stmt2->bindParam(':nombre', $nombre);
                $stmt2->bindParam(':apellido', $apellido);
                $stmt2->bindParam(':cp', $cp);
                $stmt2->bindParam(':ciudad', $ciudad);
                $stmt2->bindParam(':direccion', $direccion);
                $stmt2->execute();

                echo "Los datos han sido introducidos";
                }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        
    ?>
</body>
</body>
</html>