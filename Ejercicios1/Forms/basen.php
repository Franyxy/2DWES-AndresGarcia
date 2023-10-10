<!DOCTYPE html>
<html>
<body>
    <h1>Conversor Base</h1>
        <?php
            $num=test_input($_POST['num']);
            $base=test_input($_POST['base']);
            $arr=explode("/",$num);
            $num=$arr[0];
            $baseInicio=$arr[1];

            $sol=base_convert($num,$baseInicio,$base);
            echo "Número ".$num." en base ".$baseInicio." = ".$sol." en base ".$base;

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
</body>
</html>
