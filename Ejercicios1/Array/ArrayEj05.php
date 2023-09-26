<!DOCTYPE html>
<html>
<body>
	<?php
        $array1=["Bases de Datos","Entornos de Desarrollo","Programación"];
        $array2=["Sistemas Informáticos","FOL","Mecanizado"];
        $array3=["Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo de Interfaces","Inglés"];
        $arrayUnida1=$arrayUnida2=$arrayUnida3=[];
        $arrayUnida1= UnirArray($arrayUnida1,$array1);
        $arrayUnida1= UnirArray($arrayUnida1,$array2);
        $arrayUnida1= UnirArray($arrayUnida1,$array3);

        echo "Unir Array Sin Funciones";
        var_dump($arrayUnida1);

        $arrayUnida2=array_merge($array1,$array2,$array3);
        echo "Unir Array Con Array Merge";
        var_dump($arrayUnida2);

        $arrayUnida3= UnirArrayPush($arrayUnida3,$array1);
        $arrayUnida3= UnirArrayPush($arrayUnida3,$array2);
        $arrayUnida3= UnirArrayPush($arrayUnida3,$array3);
        echo "Unir Array Con Array Push";
        var_dump($arrayUnida3);


        function UnirArray($arrayUnida,$array){
            foreach($array as $x){
                $arrayUnida[].=$x;
            }
            return $arrayUnida;
        }
        function UnirArrayPush($arrayUnida,$array){
            foreach($array as $x){
                $arrayUnida[]=array_push($arrayUnida,$x);
            }
            return $arrayUnida;
        }

    ?>

</body>
</html>
