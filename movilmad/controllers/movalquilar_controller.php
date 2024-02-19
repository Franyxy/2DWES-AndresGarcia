<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location:./movlogin.php');
    }
    require_once("../models/movalquiler_models.php");
    $arrayVehiculos = obtenerVehiculos();
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
	
    <?php mostrarDatos(); ?>
		
		<B>Vehiculos disponibles en este momento:</B>  <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B>
			<select name="vehiculos" class="form-control">
				<?php
                //Select de los vehiculos disponibles
				foreach ($arrayVehiculos as $v) {
					echo '<option value="' . $v['matricula'] . '">' . $v["marca"] . " || " . $v["modelo"] . " || " . $v["matricula"] . '</option>';
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
    //Verificar si se ha seleccionado la opcion agregar vehiculo al carrito
    if(isset($_POST['agregar'])) {
        $matricula = $_POST['vehiculos'];
        agregar_carrito($matricula);

        //este fichero mostrara el carrito
        require_once('../views/movalquilar_view.php');
    }

    //Verificar si se ha seleccionado la opcion vaciar carrito
    if(isset($_POST['vaciar'])) {
        vaciar_carrito();
    }

    //Verificar si se ha seleccionado la opcion alquilar
    if(isset($_POST['alquilar'])) {
        if(isset($_SESSION['carrito'])){
            if(poder_alquilar()){
                foreach($_SESSION['carrito'] as $matricula){
                    alquilar_vehiculo($matricula);
                }
            }else{
                echo 'No puede alquilar más de tres vehículos al mismo tiempo.<br>Por favor devuelva al menos unos para poder hacer otra reserva.';
            }
        }else{
            echo 'NO se puede alquilar - El carrito esta vacío';
        }
        
    }

?>
</body>
</html>