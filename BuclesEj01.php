<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
$num=$num1="127";
$bin="";
while($num!=0){
    if($num%2==0){
        $bin.="0";
    }else{
        $bin.="1";
    }
    $num=bcdiv($num/2, '1', 0);
}
$bin=strrev($bin);
echo "El número ".$num1." en binario es: ".$bin;
?>
</BODY>
</HTML>
