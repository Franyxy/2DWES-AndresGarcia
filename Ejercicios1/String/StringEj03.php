<!DOCTYPE html>
<html>
<body>

<?php

$ip_masc="10.33.15.100/8";

#Separamos la ip de la mascara y las guardamos en su respectiva variable
$ip_separada=explode("/",$ip_masc);
$ip=$ip_separada[0];													
$MascaraDec=$ip_separada[1];

#Mostramos tanto la ip conmo la mascara
echo "IP: ".$ip;
echo "</br>";
echo "Máscara: ".$MascaraDec;
echo "</br>";

#Separamos la ip y guardamnos cada octeto en una array
$ArrayIpDec=explode(".",$ip);
$ArrayIpBin=[];
for($i=0;$i<4;$i++){
	$aux=decbin($ArrayIpDec[$i]);
  	$ArrayIpBin[$i]=str_pad($aux,8,"0",STR_PAD_LEFT);
}

#Restamos 32 - MAscara; para asi obtener los bits
$bit=32-$MascaraDec;

#Aplicamos la funcuión "BinArrayString"; Lo que hace es transformar la ip en binario de Array a String
#para que sea mas facil la manipulacion a la hora de cambiar los bits por 0 o 1;
$IpBinString=BinArrayString($ArrayIpBin);

#Eliminamos los bits necesarios contando de dcha a izq (el número que bits que quitamos lo calculamos anteriormente en la ln. 29)
$IpBinString_Cortada=substr($IpBinString,0,-$bit);


$IpBinDiRed=str_pad($IpBinString_Cortada,32,"0",STR_PAD_RIGHT);			#Añadimos 0's a la dcha de la string cortada para asi tener la direccion de red en binario
$IpBinDiRedArray=BinStringArray($IpBinDiRed);							#Utilizamos la funcion BinStringArray; que transforma la direccion de red binaria de string a array
$IpBinDiRedString=ArrayBinStringDec($IpBinDiRedArray);					#Utilizamos la funcion ArrayBinStringDec; que transforma la direccion de red binaria a una direccion de red decimal string
$IpBinDiRedString=substr($IpBinDiRedString,0,-1);						#Cortamos la string ya que al final sobra un . 
echo  "Dirección de Red: ".$IpBinDiRedString;
echo "</br>";

$IpBinBro=str_pad($IpBinString_Cortada,32,"1",STR_PAD_RIGHT);			#Añadimos 1's a la dcha para obtener la direccion de broadcast en binario
$IpBinBroArray=BinStringArray($IpBinBro);								#Utilizamos la funcion BinStringArray; que transforma la direccion de broadcast binaria de string a array
$IpBinBroString=ArrayBinStringDec($IpBinBroArray);						#Utilizamos la funcion ArrayBinStringDec; que transforma la direccion de broadcast binaria a una direccion de red decimal string
$IpBinBroString=substr($IpBinBroString,0,-1);							#Cortamos la string ya que al final sobra un . 
echo "Direccion De Broadcast: ".$IpBinBroString;
echo "</br>";
																		#Para el rango tenemos que sumar 1 a la direccion de Red; y restar 1 a la direccion de Broadcast

$Rango1DecArray=ArrayBinArrayDec($IpBinDiRedArray);						#Con la funcion ArrayBinArrayDec transformamos una array binaria a decimal
$Rango1DecArray[3]=$Rango1DecArray[3]+1;								#Sumamos 1 al ultimo octeto de la direccion de red
$Rango1String=ArrayString($Rango1DecArray);								#Transformamos la array en string
$Rango1String=substr($Rango1String,0,-1);								#Cortamos la string ya que al final sobra un . 

$Rango2DecArray=ArrayBinArrayDec($IpBinBroArray);						#Con la funcion ArrayBinArrayDec transformamos una array binaria a decimal
$Rango2DecArray[3]=$Rango2DecArray[3]-1;								#Restamos 1 al ultimo octeto de la direccion de broadcast
$Rango2String=ArrayString($Rango2DecArray);								#Transformamos la array en string
$Rango2String=substr($Rango2String,0,-1);								#Cortamos la string ya que al final sobra un . 

echo "Rango: ".$Rango1String." a ".$Rango2String;





function ArrayString($array){
	$string="";
	for($j=0;$j<sizeof($array);$j++){
		$string.=$array[$j].".";
    }
	return $string;
}


function ArrayBinArrayDec($array){
	$arraydec=[];
	for($j=0;$j<sizeof($array);$j++){
		$arraydec[$j]=bindec($array[$j]);
    }
	return $arraydec;
}

function ArrayBinStringDec($array){
	$stringdec="";
	for($j=0;$j<sizeof($array);$j++){
		$stringdec.=bindec($array[$j]).".";
    }
	return $stringdec;
}

function BinArrayString($array){
	$IpBinString="";
	foreach($array as $x){
		$IpBinString.=$x;
	}
	return $IpBinString;
}

function BinStringArray($string){
	$ArrayBin=str_split($string, 8);
	return $ArrayBin;
}

?>

</body>
</html>
