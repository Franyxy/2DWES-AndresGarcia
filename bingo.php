<!DOCTYPE html>
<html>
<body>

<?php
$jugador1=array();
$arrayBolas=range(1,60);
shuffle($arrayBolas);


for($i=0;$i<1;$i++){
    for($j=0;$j<15;$j++){
        $numaux=rand(1,60);
        $aux=comprobarNumRepetido($jugador1,$numaux);
        while($aux==1){
            $numaux=rand(1,60);
            $aux=comprobarNumRepetido($jugador1,$numaux);
        }
        $jugador1[$i][$j]=$numaux;
    }
}
var_dump($jugador1);
$hola= count($jugador1);
echo $hola;



function comprobarNumRepetido($jugador1,$aux){
    foreach($jugador1 as $carton1){
        foreach($carton1 as $x){
            if($aux==$x){
                return 1;
            }
        }
    }
    return 0;
}




?>

</body>
</html>