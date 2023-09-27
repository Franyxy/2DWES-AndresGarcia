<!DOCTYPE html>
<html>
<body>
    <p>Matriz Normal</p>
    <table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            $matriz=$matriztraspuesta=[];
            $filas=$col=3;
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$col;$j++){
                    $matriz[$i][$j]=rand(-10,10);
                    echo "<td style='width:100px;'>".$matriz[$i][$j]."</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
        </br>
        <p>Matriz Traspuesta</p>
    <table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            for($i=0;$i<$filas;$i++){
                for($j=0;$j<$col;$j++){
                    $matriztraspuesta[$j][$i]=$matriz[$i][$j];
                }
            }
            for($i=0;$i<$filas;$i++){
                echo "<tr>";
                for($j=0;$j<$col;$j++){
                    echo "<td style='width:100px;'>".$matriztraspuesta[$i][$j]."</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
