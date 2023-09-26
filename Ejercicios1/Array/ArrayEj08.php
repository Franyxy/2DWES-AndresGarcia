<!DOCTYPE html>
<html>
<body>
	<?php
        $notas=array("Edu"=>"7.0", "Andres"=>"10.0", "Gonzalo"=>"8.5","Victor"=>"9.0","Calixto"=>"7.5");
        $suma=0;
        asort($notas);
        foreach($notas as $x=>$i){
            echo "Nombre: " . $x . " || Nota: " . $i;
            echo "<br>";
            $suma=$suma+$i;
        }
        echo "</br>";
        echo "El alumno con la nota más baja es: ".reset($notas);
        echo "</br>";
        echo "El alumno con la nota más alta es: ".end($notas);
        echo "</br>";
        echo "La media del curso es de: ".($suma/(sizeof($notas)));
    ?>

</body>
</html>
