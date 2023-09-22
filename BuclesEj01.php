<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
$num=$num1="127";
$sol="";
while($num!=0){
    $aux=$num%2;
    $sol.=$aux;
    $num=bcdiv($num/2, '1', 0);
}
$sol=strrev($sol);
echo "El número ".$num1." en binario es: ".$sol;
?>
</BODY>
</HTML>
