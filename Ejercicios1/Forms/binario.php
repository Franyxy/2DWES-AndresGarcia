<!DOCTYPE html>
<html>
<body>
    <h1>Calculadora Binario</h1>
        <?php
            $num=test_input($_POST['num']);

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $resultado=decbin($num);


            echo '<label>Decimal </label><input value="'.$num.'"></input><br>';
            echo '<label>Binario </label><input value="'.$resultado.'"></input>';
        ?>
</body>
</html>
