<!DOCTYPE html>
<html>
<body>
	<?php
        $edad=array("Edu"=>"22", "Andres"=>"20", "Gonzalo"=>"18","Victor"=>"19","Calixto"=>"23");
        foreach($edad as $x=>$i){
            echo "Nombre: " . $x . " || Edad: " . $i;
            echo "<br>";
        }
        echo "</br>";
        $aux=next($edad);
        echo "El puntero colocado en la segunda posicion tiene de valor: ".$aux;
        echo "</br>";
        $aux=next($edad);
        echo "El puntero con una posicion más tiene de valor: ".$aux;
        echo "</br>";
        $aux=end($edad);
        echo "El puntero en la última posición tiene de valor: ".$aux;
        echo "</br>";echo "</br>";
        asort($edad);
        foreach($edad as $x=>$i){
            echo "Nombre: " . $x . " || Edad: " . $i;
            echo "<br>";
        }
        echo "</br>";
        echo "La primera posición del array tiene como valor: ".reset($edad);
        echo "</br>";
        echo "La ultima posición del array tiene como valor: ".end($edad);
        echo "</br>";
    ?>

</body>
</html>
