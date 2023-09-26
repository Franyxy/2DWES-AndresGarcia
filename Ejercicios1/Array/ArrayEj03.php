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
        $arrayBin=[];
        for($i=0;$i<=20;$i++){
            $arrayBin[$i]=decbin($i);  
        }
        $cont=0;
        foreach($arrayBin as $x){
            echo "<tr>";
            echo "<td>".$cont."</td>";
			echo "<td>".$x."</td>";
			echo "<td>".(decoct($cont))."</td>";
			echo "</tr>";
            $cont++;
        }
		
	?>
</table>
</body>
</html>
