<!DOCTYPE HTML>  
<html>
<head>

</head>
<body>  

<h2>Calculadora</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <label for="op1"> Operando1:</label>    
    <input type="text" name="op1" id="op1" ><br><br>
    <label for="op2"> Operando2:</label>    
    <input type="text" name="op2" id="op2" ><br><br><br>
    <label> Operacion</label><br>
    <input type="radio" name="operando" value="sum">Suma<br>
    <input type="radio" name="operando" value="rest">Resta<br>
    <input type="radio" name="operando" value="prod">Multiplicacion<br>
    <input type="radio" name="operando" value="div">Division<br><br>
    <input type="submit">
    <input type="reset"> <br><br>
</form>

<?php
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $resultado=0;
        $op1=test_input($_POST['op1']);
        $op2=test_input($_POST['op2']);
        $opcion=test_input($_POST['operando']);
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