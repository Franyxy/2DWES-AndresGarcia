<!DOCTYPE html>
<html>
<body>
<table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            $matriz=[];
            for($filas=0;$filas<3;$filas++){
                echo "<tr>"; 
                for($col=0;$col<5;$col++){
                    $matriz[$filas][$col]=$filas+$col;
                    echo "<td>".$matriz[$filas][$col]."</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
