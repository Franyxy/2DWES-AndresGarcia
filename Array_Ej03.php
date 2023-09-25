<!DOCTYPE html>
<html>
<body>
<table border="1" style="width:300px;border-collapse: collapse;text-align:center;">
	<tr>
        <th>Indice</th>
        <th>Binario</th>
		<th>Octal</th>
    </tr>
	<?php
		$cont=0;
		while($cont<=20){
			echo "<tr>";
            echo "<td>".$cont."</td>";
			echo "<td>".decbin($cont)."</td>";
			echo "<td>".decoct($cont)."</td>";
			echo "</tr>";
			$cont++;
		}
	?>
</table>
</body>
</html>
