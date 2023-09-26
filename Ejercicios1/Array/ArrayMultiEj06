<!DOCTYPE html>
<html>
<body>
<table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            $matriz=$valormax=$prom=[];
            $filas=$col=3;
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$col;$j++){
                    $matriz[$i][$j]=rand(-10,10);
                    echo "<td>".$matriz[$i][$j]."</td>";
                }
                echo "</tr>";
            }
            for($j=0;$j<$filas;$j++){
                $valormax[$j]=valorMaxFilas($j,$col,$matriz);
                echo "El valor máximo de la fila ".($j+1)." es: ".$valormax[$j];
                echo "</br>";
                $prom[$j]=bcdiv((sumarFilas($col,$matriz,$j)/$col),'1',2);
                echo "El promedio de la fila ".($j+1)." es de: ".$prom[$j];
                echo "</br>";echo "</br>";
            }
            echo "</br>";echo "</br>";
            
            function valorMaxFilas($num,$col,$matriz){
                $aux=-INF;
                for($j=0;$j<$col;$j++){
                    if($matriz[$j][$num]>$aux){
                        $aux=$matriz[$j][$num];
                    }
                }
                return $aux;
            }

            function sumarFilas($col,$matriz,$num){
                $sum=0;
                for($j=0;$j<$col;$j++){
                    $sum=$sum+$matriz[$j][$num]; 
                }
                return $sum;
            }
        ?>
    </table>
</body>
</html>
