<!DOCTYPE html>
<html>
<body>
    <h1>Calculadora</h1>
        <?php
            $resultado=0;
            $op1=test_input($_POST['op1']);
            $op2=test_input($_POST['op2']);
            $opcion=test_input($_POST['operando']);

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if($opcion=='sum'){
                $resultado=$op1+$op2;
                echo "El resultado de la operacion ".$op1."+".$op2."=".$resultado;
            }elseif($opcion=='rest'){
                $resultado=$op1-$op2;
                echo "El resultado de la operacion ".$op1."-".$op2."=".$resultado;
            }elseif($opcion=="prod"){
                $resultado=$op1*$op2;
                echo "El resultado de la operacion ".$op1."x".$op2."=".$resultado;
            }else{
                $resultado=$op1/$op2;
                echo "El resultado de la operacion ".$op1."/".$op2."=".$resultado;
            }
        ?>
</body>
</html>
