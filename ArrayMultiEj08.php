<!DOCTYPE html>
<html>
<body>
<table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            $matriz1=$matriz2=$matrizsum=$matrizprod=[];
            $filas=$col=3;
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$col;$j++){
                    $matriz1[$i][$j]=rand(-10,10);
                    echo "<td style='width:100px;'>".$matriz1[$i][$j]."</td>";
                }
                echo "</tr>";
            }

        ?>
    </table>
    </br>
    <table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$col;$j++){
                    $matriz2[$i][$j]=rand(-10,10);
                    echo "<td style='width:100px;'>".$matriz2[$i][$j]."</td>";
                }
                echo "</tr>";
            }

        ?>
    </table>
    </br>
    <p>Suma de las arrays</p>
    <table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$col;$j++){
                    $matrizsum[$i][$j]=$matriz1[$i][$j]+$matriz2[$i][$j];
                    echo "<td style='width:100px;'>".$matrizsum[$i][$j]."</td>";
                }
                echo "</tr>";
            }

        ?>
    </table>
    </br>
    <p>Producto de las arrays</p>
    <table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$col;$j++){
                    $matrizspro[$i][$j]=multiplicacionMatriz($matriz1,$matriz2,$i,$j);
                    echo "<td style='width:100px;'>".$matrizspro[$i][$j]."</td>";
                }
                echo "</tr>";
            }


            function multiplicacionMatriz($matriz1,$matriz2,$i,$j){
                $prod=$aux=0;
                for($k=0;$k<3;$k++){
                    $aux=($matriz1[$i][$k]*$matriz2[$k][$j]);
                    $prod=$prod+$aux;
                }
                return $prod;
            }
        ?>
    </table>
</body>
</html>
