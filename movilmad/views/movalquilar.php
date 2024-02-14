<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location:./movlogin.php');
    }
	require_once("../controllers/movalquilar_controller.php");
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
		<div class="card-header">Menú Usuario - ALQUILAR VEHÍCULOS</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	
		<B>Bienvenido/a: </B><?php echo $_SESSION['nombre'];?><BR><BR>
		<B>Identificador Cliente: </B><?php echo $_SESSION['identificador'];?><BR><BR>
		
		<B>Vehiculos disponibles en este momento:</B>  <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B>
			<select name="vehiculos" class="form-control">
				<?php
				foreach ($arrayVehiculos as $v) {
					echo '<option value="' . $v['matricula'] . '">' . $v["marca"] . " || " . $v["modelo"] . '</option>';
				}
				?>
			</select>
			
		
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="agregar" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="alquilar" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="vaciar" name="vaciar" class="btn btn-warning disabled">
		</div>		
	</form>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		require_once("../controllers/formalquiler_controller.php");
	}
	?>
</body>
</html>

