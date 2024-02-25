<?php
	require_once("../models/global.php");
	test_inicio();
    require_once("../models/movdevolver_models.php");
    $arrayVehiculosDevolver = obtenerVehiculosDevolver();
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - DEVOLUCIÓN VEHÍCULO </div>
		<div class="card-body">

	<!-- INICIO DEL FORMULARIO -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	
    <?php mostrarDatos(); ?>
			<B>Matricula/Marca/Modelo: </B>
			<select name="vehiculos" class="form-control">
				<?php
                //Select de los vehiculos disponibles para devolver
				foreach ($arrayVehiculosDevolver as $v) {
					echo '<option value="' . $v['matricula'] . '">' . $v["marca"] . " || " . $v["modelo"] . " || " . $v["matricula"] . '</option>';
				}
				?>
			</select>
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Devolver Vehiculo" name="devolver" class="btn btn-warning disabled">
            <a href="../views/movwelcome.php" class="btn btn-warning">Menu</a>

		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href = "./cerrarsesion.php">Cerrar Sesion</a>
	
</body>
</html>

<?php
    if(isset($_POST['devolver'])) {
        $cocheDevolver_matricula = test_input($_POST['vehiculos']);
		$fecha = obtenerFecha($cocheDevolver_matricula);
		$minutos = obtenerMinutos($fecha);
		$tarifa = obtenerTarifa($cocheDevolver_matricula);
		$amount = $tarifa * $minutos;
		$orderNumber =  generarCodigoAleatorio();

		// Guardar los datos en variables de sesión
		$_SESSION['transaccion_fecha'] = date('Y-m-d H:i:s');
		$_SESSION['matricula'] = $cocheDevolver_matricula;
		$_SESSION['transaccion_amount'] = $amount;
		$_SESSION['transaccion_orderNumber'] = $orderNumber;


		$amount = convertirPrecio($amount);
		pasarela($amount, $orderNumber);
    }

?>



