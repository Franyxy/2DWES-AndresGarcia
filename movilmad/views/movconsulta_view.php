<table border="1" style="border: 2px solid black">
<tr><th>Marca</th><th>Modelo</th><th>Matricula</th><th>Fecha Alquiler</th></tr>
<?php
    foreach($arrayAlquileres as $vehiculo){
        echo "<tr>";
        echo "<td>".$vehiculo['marca']."</td>";
        echo "<td>".$vehiculo['modelo']."</td>";
        echo "<td>".$vehiculo['matricula']."</td>";
        echo "<td>".$vehiculo['fecha_alquiler']."</td>";
        echo "</tr>";
    }
?>
</table>
