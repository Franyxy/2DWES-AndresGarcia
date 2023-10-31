<HTML>
<HEAD> <TITLE> Ficheros 3 </TITLE> </HEAD>
<table border="1" style="width:500px;border-collapse: collapse;text-align:center;">
<tr>
    <th>Nombre</th>
    <th>Apellido 1</th>
    <th>Apellido 2</th>
    <th>Fecha Nacimiento</th>
    <th>Localidad</th>
</tr>
<BODY>
<?php
$cont=0;
    $a1=file("alumnos1.txt");
    foreach($a1 as $linea=>$texto) {
        $nombre = substr($texto, 0, 40);
        $apellido1 = substr($texto, 40, 40);
        $apellido2 = substr($texto, 80, 41);
        $fecha = substr($texto, 121, 10);     
        $loc = substr($texto, 131); 
        echo "<tr>";
        echo "<td>".$nombre."</td>";
        echo "<td>".$apellido1."</td>";
        echo "<td>".$apellido2."</td>";
        echo "<td>".$fecha."</td>";
        echo "<td>".$loc."</td>";
        echo "</tr>";
        $cont++;
    };
    echo "Hay ".$cont." alumnos.<br>";
?>
</table>
</BODY>
</HTML>
