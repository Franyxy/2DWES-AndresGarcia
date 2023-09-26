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
                $sumfilas[$k]=sumarFilas($col,$matriz,$k);
                $sumcol[$k]=sumarCol($filas,$matriz,$k);
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

            function sumarFilas($col,$matriz,$num){
                $sum=0;
                for($j=0;$j<$col;$j++){
                    $sum=$sum+$matriz[$j][$num]; 
                }
                
                return $sum;
            }
            function sumarCol($filas,$matriz,$num){
                $sum=0;
                for($i=0;$i<$filas;$i++){
                    $sum=$sum+$matriz[$num][$i];
                }
                return $sum;
            }
            
        ?>
    </table>
</body>
</html>
