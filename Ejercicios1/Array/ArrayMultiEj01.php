<!DOCTYPE html>
<html>
<body>
<table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <?php
            $matriz=[];
            $cont=2;
            for($filas=0;$filas<3;$filas++){
                echo "<tr>"; 
                for($col=0;$col<3;$col++){
                    $matriz[$filas][$col]=$cont;
                    $cont=$cont+2;
                    echo "<td>".$matriz[$filas][$col]."</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
