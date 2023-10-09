<!DOCTYPE HTML>  
<html>
<head>

</head>
<body>  

<h1>Cambio Base</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<label for="num"> Decimal</label>    
        <input type="text" name="num" id="num"><br><br>
        <label for="op2"> Cambiar a base: </label><br>  

        <input type="radio" name="operando" value="bin">Binario<br>
        <input type="radio" name="operando" value="oct">Octal<br>
        <input type="radio" name="operando" value="hex">Hexadecimal<br>
        <input type="radio" name="operando" value="todos">Todos<br>
        <input type="submit">
        <input type="reset"><br><br>
</form>

<?php
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $resultado=0;
            $num=test_input($_POST['num']);
            $opcion=test_input($_POST['operando']);
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
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

</body>
</html>