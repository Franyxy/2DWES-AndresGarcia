<!DOCTYPE html>
<html>
<body>
<h1>Cambio Base</h1>
        <?php
            $resultado=0;
            $num=test_input($_POST['num']);
            $opcion=test_input($_POST['operando']);

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            echo '<table border="1" style="width:300px;border-collapse: collapse;text-align:center;">';
                switch ($opcion) {
                    case "bin":
                        echo "<tr>";
                        echo "<td>Binario</td>";
                        echo "<td>".decbin($num)."</td>";
                        echo "</tr>";
                        break;
                    case "oct":
                        echo "<tr>";
                        echo "<td>Octal</td>";
                        echo "<td>".decoct($num)."</td>";
                        echo "</tr>";
                        break;
                    case "hex":
                        echo "<tr>";
                        echo "<td>Hexadecimal</td>";
                        echo "<td>".dechex($num)."</td>";
                        echo "</tr>";
                        break;
                    case "todos":
                        echo "<tr>";
                        echo "<td>Binario</td>";
                        echo "<td>".decbin($num)."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Octal</td>";
                        echo "<td>".decoct($num)."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Hexadecimal</td>";
                        echo "<td>".dechex($num)."</td>";
                        echo "</tr>";
                        break;
                }
            echo "</table>";
        ?>
</body>
</html>
