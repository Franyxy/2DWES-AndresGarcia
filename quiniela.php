<HTML>
<HEAD> <TITLE>QUINELA</TITLE> </HEAD>
<STYLE>
table {
  border-collapse: collapse;
}
td, tr{
  border: 1px solid black;
  text-align: left;
  padding: 8px;
}
</STYLE>
<BODY>
<form name='mi_formulario' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>
<?php
$numeros_generados = array();
$min = 0;
$max = 27;
//$i = 0;
$cantidad_numeros = 27;
$jornada = array();
$quinela = array();
$resultados = "1X2";
$rango = range(0, 27);

$equipos = array(
	"Alavés",
	"Athletic Bilbao",
	"Atlético de Madrid",
	"Barcelona",
	"Cádiz",
	"Celta de Vigo",
	"Elche",
	"Espanyol",
	"Getafe",
	"Granada",
	"Levante",
	"Mallorca",
	"Osasuna",
	"Rayo Vallecano",
	"Real Betis",
	"Real Madrid",
	"Real Sociedad",
	"Sevilla",
	"Valencia",
	"Villarreal",
	"Albacete",
	"Malaga",
	"Leganes",
	"Huesca",
	"Zaragoza",
	"Hercules",
	"Andorra",
	"Racing"
);
//Genero los partidos de una jornada aleatoriamente
if ($cantidad_numeros > ($max - $min + 1)) {
	echo "No se pueden generar más números únicos que la longitud del rango.";
}else {
	while(count($numeros_generados) != 28){
		do {
			$numero_aleatorio = rand($min, $max);
			$numero_aleatorio2 = rand($min, $max);
		} while (in_array($numero_aleatorio, $numeros_generados) || in_array($numero_aleatorio2, $numeros_generados) || $numero_aleatorio == $numero_aleatorio2);
			$numeros_generados[] = $numero_aleatorio;
			$numeros_generados[] = $numero_aleatorio2;
			$jornada[] = array($equipos[$numero_aleatorio], $equipos[$numero_aleatorio2]);
	}
}


/*for($jornadas = 0; $jornadas < 56; $jornadas++){
	if ($cantidad_numeros > ($max - $min + 1)) {
		echo "No se pueden generar más números únicos que la longitud del rango.";
	}else {
		while(count($numeros_generados) != 28){
			do {
				$numero_aleatorio = rand($min, $max);
				$numero_aleatorio2 = rand($min, $max);
			} while (in_array($numero_aleatorio, $numeros_generados) || in_array($numero_aleatorio2, $numeros_generados) || $numero_aleatorio == $numero_aleatorio2);
				$numeros_generados[] = $numero_aleatorio;
				$numeros_generados[] = $numero_aleatorio2;
				$jornada[$jornadas][$i] = array($equipos[$numero_aleatorio], $equipos[$numero_aleatorio2]);
				$i++;
				if($i == 27){
					$i=0;
				}
				//shuffle($equipos);
				//$jornada2[] = array($equipos[$numero_aleatorio], $equipos[$numero_aleatorio2]);
		}
		
	}
	foreach($numeros_generados as $key => $value){
		unset($numeros_generados[$key]); 
	}
	shuffle($equipos);
}*/

//Creo la tabla donde digo los partidos y luego la columna con los resultados
$tabla2 = "
<table>
	<tr>
		<td><input type='text' name='partido1' value='".$jornada[0][0]." vs ".$jornada[0][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado1' value='1' required/>1
			<input type='radio' name='resultado1' value='X' required/>X
			<input type='radio' name='resultado1' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido2' value='".$jornada[1][0]." vs ".$jornada[1][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado2' value='1' required/>1
			<input type='radio' name='resultado2' value='X' required/>X
			<input type='radio' name='resultado2' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido3' value='".$jornada[2][0]." vs ".$jornada[2][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado3' value='1' required/>1
			<input type='radio' name='resultado3' value='X' required/>X
			<input type='radio' name='resultado3' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido4' value='".$jornada[3][0]." vs ".$jornada[3][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado4' value='1' required/>1
			<input type='radio' name='resultado4' value='X' required/>X
			<input type='radio' name='resultado4' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido5' value='".$jornada[4][0]." vs ".$jornada[4][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado5' value='1' required/>1
			<input type='radio' name='resultado5' value='X' required/>X
			<input type='radio' name='resultado5' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido6' value='".$jornada[5][0]." vs ".$jornada[5][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado6' value='1' required/>1
			<input type='radio' name='resultado6' value='X' required/>X
			<input type='radio' name='resultado6' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido7' value='".$jornada[6][0]." vs ".$jornada[6][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado7' value='1' required/>1
			<input type='radio' name='resultado7' value='X' required/>X
			<input type='radio' name='resultado7' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido8' value='".$jornada[7][0]." vs ".$jornada[7][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado8' value='1' required/>1
			<input type='radio' name='resultado8' value='X' required/>X
			<input type='radio' name='resultado8' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido9' value='".$jornada[8][0]." vs ".$jornada[8][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado9' value='1' required/>1
			<input type='radio' name='resultado9' value='X' required/>X
			<input type='radio' name='resultado9' value='2' required/>2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido10' value='".$jornada[9][0]." vs ".$jornada[9][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado10' value='1'required />1
			<input type='radio' name='resultado10' value='X'required />X
			<input type='radio' name='resultado10' value='2'required />2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido11' value='".$jornada[10][0]." vs ".$jornada[10][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado11' value='1'required />1
			<input type='radio' name='resultado11' value='X'required />X
			<input type='radio' name='resultado11' value='2'required />2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido12' value='".$jornada[11][0]." vs ".$jornada[11][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado12' value='1'required />1
			<input type='radio' name='resultado12' value='X'required />X
			<input type='radio' name='resultado12' value='2'required />2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido13' value='".$jornada[12][0]." vs ".$jornada[12][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado13' value='1'required />1
			<input type='radio' name='resultado13' value='X'required />X
			<input type='radio' name='resultado13' value='2'required />2
		</td>
	</tr>
	<tr>
		<td><input type='text' name='partido14' value='".$jornada[13][0]." vs ".$jornada[13][1]."' readonly /></td>
		<td>
			<input type='radio' name='resultado14' value='1'required />1
			<input type='radio' name='resultado14' value='X'required />X
			<input type='radio' name='resultado14' value='2'required />2
		</td>
	</tr>
</table>
<br/>";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//Guarda los resultados que hemos introducido en la tabla, pero no consigo que guarden los partidos que estan relacionados a los resultados
	for($i = 0; $i < 14; $i++){
		$r = $i + 1;
		$columna[$i][0] = test_input($_POST["partido".$r]);
		$columna[$i][1] = ($_POST["resultado".$r]);
	}
    echo "<table>";
	for($i = 0; $i < 14; $i++){
        echo "<tr>";
		$r = $i + 1;
		echo "<td>".$columna[$i][0]."</td>";
        echo "<td>".$columna[$i][1]."</td>";
        echo "</tr>";
	}
    echo "</table><br><br><br>";
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

echo $tabla2;
?>
<input type='submit' name='Enviar'/>
</form>
</BODY>
</HTML>