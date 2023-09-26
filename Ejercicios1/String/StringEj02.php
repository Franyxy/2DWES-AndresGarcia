<!DOCTYPE html>
<html>
<body>

<?php
$ip="192.18.16.204";
$ip_bin="";
$array=explode(".",$ip);
foreach($array as $x){
    $x=decbin($x);
    $x=str_pad($x,8,"0",STR_PAD_LEFT);
    $ip_bin.=$x.".";
}
echo $ip_bin;
?>

</body>
</html>
