<!DOCTYPE html>
<html>
<body>
    <h1>Datos Alumno</h1>
    <table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            $name=test_input($_POST['nombre']);
            $apell1=test_input($_POST['apell1']);
            $apell2=test_input($_POST['apell2']);
            $email=test_input($_POST['email']);
            $sexo=test_input($_POST['sexo']);

            echo "<tr>";
            echo "<td>Nombre</td>";
            echo "<td>Apellido 1</td>";
            echo "<td>Apellido 2</td>";
            echo "<td>E-mail</td>";
            echo "<td>Sexo</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>".$name."</td>";
            echo "<td>".$apell1."</td>";
            echo "<td>".$apell2."</td>";
            echo "<td>".$email."</td>";
            echo "<td>".$sexo."</td>";
            echo "</tr>";
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
    </table>
</body>
</html>
