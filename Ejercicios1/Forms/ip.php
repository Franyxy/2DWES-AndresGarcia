<!DOCTYPE html>
<html>
<body>
    <h1>IP</h1>
        <?php
            $StrIpDec=test_input($_POST['num']);
            $ArrIpDec=explode(".",$StrIpDec);
            $ArrIpBin=array();
            $StrIpBin="";

            for($i=0;$i<4;$i++){
                $aux=decbin($ArrIpDec[$i]);
                $ArrIpBin[$i]=str_pad($aux,8,"0",STR_PAD_LEFT);
                $StrIpBin.=$ArrIpBin[$i].".";
            }
            $StrIpBin=substr($StrIpBin,0,-1);
            echo '<label for="ip">IP Decimal  </label>';
            echo "<input size='20' name='hola' value='$StrIpDec'><br><br>";

            echo '<label for="ip">IP Binario  </label>';
            echo "<input size='35' name='hola' value='$StrIpBin'>";

            

            

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
</body>
</html>
