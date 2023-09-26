<!DOCTYPE html>
<html>
<body>

<?php
$ip="192.18.16.204";
$array=explode(".",$ip);
foreach($array as $x){
    printf("%b",$x);
    printf(".");
}
?>

</body>
</html>
