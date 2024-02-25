<?php
    require_once("../models/global.php");
	test_inicio();
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
	
    <?php
        mostrarDatos(); 
            echo "<B>Vehiculos disponibles: </B>" . date('d/m/y h:i:s') . "<BR><BR>";
    ?>
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
            <a href="../views/movwelcome.php" class="btn btn-warning">Menu</a>
		</div>		
	</form>

	<?php

    //Verificar si se ha seleccionado la opcion agregar vehiculo al carrito
    if(isset($_POST['agregar'])) {
        $matricula = $_POST['vehiculos'];
        agregar_carrito($matricula);

    }

    //Verificar si se ha seleccionado la opcion vaciar carrito
    if(isset($_POST['vaciar'])) {
        vaciar_carrito();
    }

    if(isset($_POST['alquilar'])) {
        //Verificar si se ha seleccionado la opcion alquilar

        if(isset($_SESSION['carrito'])){
            //Verificar si carrito esta vacio

            if(poder_alquilar(sizeof($_SESSION['carrito']))){
                //Verificar si el numero de vehiculos corresponde con los que puede alquilar

                foreach($_SESSION['carrito'] as $matricula){
                    //Alquilar cada uno de los vehiculos del carrito
                    alquilar_vehiculo($matricula);

                    
                }
                header('location ./');
                echo 'Vehiculos Alquilados<br>';

                //Vaciamos el carrito para una futura compra
                vaciar_carrito();
            }else{
                echo 'No puede alquilar más de tres vehículos al mismo tiempo.<br>Por favor devuelva los vehiculos para poder hacer otra reserva.';
            }
        }else{
            echo 'NO se puede alquilar - El carrito esta vacío';
        }
        
    }

     //este fichero mostrara el carrito
    require_once('../views/movalquilar_view.php');

?>
</body>
</html>