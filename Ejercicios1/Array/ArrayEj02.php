<!DOCTYPE html>
<html>
<body>
<table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
        <tr>
            <th>Tipo</th>
            <th>Media</th>
        </tr>
	<?php
        $sumpar=$sumimpar=$cont=0;
        $par=$impar=[];
		while($cont<=20){
			if($cont%2==0){
                array_push($par,$cont);
                $sumpar=$sumpar+$cont;
            }else{
                array_push($impar,$cont);
                $sumimpar=$sumimpar+$cont;
            }
            $cont++;
		}
        echo "<tr>";
		echo "<td> PAR </td>";
		echo "<td>".($sumpar/sizeof($par))."</td>";
		echo "</tr>";
        echo "<tr>";
		echo "<td> IMPAR </td>";
		echo "<td>".($sumimpar/sizeof($impar))."</td>";
		echo "</tr>";
	?>
</table>


</body>
</html>
