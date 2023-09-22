<HTML>
<HEAD><TITLE> EJ2B – Conversor Decimal a base n </TITLE></HEAD>
<BODY>
<?php
$num="48";
$base="7";
$sol=Conversor($num,$base);
echo "El número ".$num." en base ".$base." es: ".$sol;
function Conversor($num,$base){
    $sol="";
    while($num!=0){
        $aux=$num%$base;
        $sol.=$aux;
        $num=bcdiv($num/$base, '1', 0);
    }
    $sol=strrev($sol);
    return $sol;
}
?>
</BODY>
</HTML>
