<!DOCTYPE html>
<html>
<body>
    <table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            $matriz=array();
            $filas=3;$col=5;
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$col;$j++){
                    $matriz[$i][$j]=rand(-10,10);
                    echo "<td style='width:100px;'>".$matriz[$i][$j]."</td>";
                }
                echo "</tr>";
            }
            echo "Por filas";echo "</br>";
            for($i=0;$i<$filas;$i++){
                for($j=0;$j<$col;$j++){
                    echo "Elemento (".$i.",".$j.")= ".$matriz[$i][$j]."</td>";
                    echo "</br>";
                }
            }
            echo "</br>";echo "Por Columnas";echo "</br>";
            for($i=0;$i<$col;$i++){
                for($j=0;$j<$filas;$j++){
                    echo "Elemento (".$i.",".$j.")= ".$matriz[$j][$i]."</td>";
                    echo "</br>";
                }
            }
            echo "</br>";
            echo "MATRIZ";
            foreach($matriz as $x){
                foreach($x as $y){
                    echo $y;
                }
            }
        ?>
    </table>
</body>
</html>
