<!DOCTYPE html>
<html>
<body>
    <h1>Calculadora</h1>
        <?php
            $resultado=0;$simbolo="";
            $op1=$_POST['op1'];
            $op2=$_POST['op2'];
            $opcion=$_POST['operando'];

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
