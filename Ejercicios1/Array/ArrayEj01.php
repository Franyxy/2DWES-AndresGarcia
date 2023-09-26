<!DOCTYPE html>
<html>
<body>
<table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
	<tr>
        <th>Indice</th>
        <th>Valor</th>
		<th>Suma</th>
    </tr>
	<?php
		$cont=$sum=0;$valor=1;
		$array=[];
		for($i=0;$i<=20;$i++){
			$array[$i]=$valor;
			$valor=$valor+2;
		}
		$cont=0;
		foreach($array as $valor){
			$sum=$sum+$valor;
			echo "<tr>";
            echo "<td>".$cont."</td>";
			echo "<td>".$valor."</td>";
			echo "<td>".$sum."</td>";
			echo "</tr>";
			$cont++;
		}
	?>
</table>


</body>
</html>
