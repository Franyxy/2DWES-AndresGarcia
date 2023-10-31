<HTML>
<HEAD> <TITLE> Ficheros 2 </TITLE> </HEAD>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="nombre">Nombre:</label>
	<input type="text" id="nombre" name="nombre" /><br><br>

	<label for="apellido1">Primer Apellido:</label>
	<input type="text" id="apellido1" name="apellido1" /><br><br>

	<label for="apellido2">Segundo Apellido:</label>
	<input type="text" id="apellido2" name="apellido2" /><br><br>

	<label for="fecha">Fecha Nacimiento:</label>
	<input type="text" id="fecha" name="fecha" /><br><br>

	<label for="loc">Localidad:</label>
	<input type="text" id="loc" name="loc" /><br><br>

	<input type="submit" value="Enviar">

</form>
<BODY>
<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$nombre=test_input($_POST['nombre']);
		$apellido1=test_input($_POST['apellido1']);
		$apellido2=test_input($_POST['apellido2']);
		$fecha=test_input($_POST['fecha']);
		$loc=test_input($_POST['loc']);

		$a1=fopen("alumnos2.txt","a+");
		$nombre=$nombre."##";
		$apellido1=$apellido1."##";
        $apellido2=$apellido1."##";
        $fecha=$fecha."##";
        $loc=$loc."##";

		fwrite($a1,$nombre);
		fwrite($a1,$apellido1);
		fwrite($a1,$apellido2);
		fwrite($a1,$fecha);
		fwrite($a1,$loc."\n");
		fclose($a1);
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
</BODY>
</HTML>
