<!DOCTYPE html>
<html>
<body>
	<?php
        $age=array("Edu"=>"22", "Andres"=>"20", "Gonzalo"=>"18","Victor"=>"19","Calixto"=>"23");
        foreach($age as $x=>$i){
            echo "Nombre: " . $x . " || Edad: " . $i;
            echo "<br>";
        }
        $aux=key($age,"Andres");
        echo $aux;

    ?>

</body>
</html>
