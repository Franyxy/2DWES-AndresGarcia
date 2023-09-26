<!DOCTYPE html>
<html>
<body>
<table border="1" style="width:100px;border-collapse: collapse;text-align:center;">
        <?php
            $matriz=$sumfilas=$sumcol=[];
            $filas=$col=3;
            $cont=2;
            for($i=0;$i<$filas;$i++){
                for($j=0;$j<$col;$j++){
                    $matriz[$i][$j]=$cont;
                    $cont=$cont+2;
                }
            }
            for($k=0;$k<$filas;$k++){
                $sumfilas[$k]=sumarFilas($filas,$col,$matriz,$k);
                $sumcol[$k]=sumarCol($filas,$col,$matriz,$k);
            }
            echo "<tr>";
            echo "<td></td>";
            foreach($sumfilas as $x){
                echo "<td>".$x."</td>";
            }
            echo "</tr>";
            foreach($sumcol as $x){
                echo "<tr>";
                echo "<td>".$x."</td>";
                echo "</tr>";
            }

            function sumarFilas($filas,$col,$matriz,$num){
                $sum=0;
                for($i=0;$i<$filas;$i++){
                    for($j=0;$j<$col;$j++){
                        if($num==$j){
                            $sum=$sum+$matriz[$i][$j];
                        }
                    }
                }
                return $sum;
            }
            function sumarCol($filas,$col,$matriz,$num){
                $sum=0;
                for($i=0;$i<$filas;$i++){
                    for($j=0;$j<$col;$j++){
                        if($num==$i){
                            $sum=$sum+$matriz[$i][$j];
                        }
                    }
                }
                return $sum;
            }
            
        ?>
    </table>
</body>
</html>
