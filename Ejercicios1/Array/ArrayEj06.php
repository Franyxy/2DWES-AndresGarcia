<!DOCTYPE html>
<html>
<body>
	<?php
        $array1=["Bases de Datos","Entornos de Desarrollo","Programación"];
        $array2=["Sistemas Informáticos","FOL","Mecanizado"];
        $array3=["Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo de Interfaces","Inglés"];
        $arrayUnida=[];

        $arrayUnida=array_merge($array1,$array2,$array3);
        $aux = array_search('Mecanizado', $arrayUnida);
        unset($arrayUnida[$aux]);
        $arrayUnida=array_reverse($arrayUnida);
        var_dump($arrayUnida);

    ?>

</body>
</html>
