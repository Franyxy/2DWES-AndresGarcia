<?php
//Comprueba si el carrito existe / está vacio o no
if(isset($_SESSION['carrito'])){
?>
<table border="1" style="border: 2px solid black">
<p>Cesta de Compra</p>
<tr><th>Orden</th><th>Matrícula</th></tr>
<?php
    $cont = 1;
    foreach($_SESSION['carrito'] as $mat){
        echo "<tr>";
        echo "<td>".$cont."</td>";
        echo "<td>".$mat."</td>";
        echo "</tr>";
        $cont += 1;
    }
?>
</table>
<?php
} else {
    //Texto que se muestra si la cesta esta vacia
    echo "<p>No hay elementos en la cesta de compra.</p>";
}
?>