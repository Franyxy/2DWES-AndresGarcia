<html>
    <body>
        <h1>Conversor Binario</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="num"> Decimal</label>    
        <input type="text" name="num" id="num"><br><br>
        <input type="submit">
        <input type="reset">
        </form>
    </body>
    <?php
    
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $num=test_input($_POST['num']);
            $resultado=decbin($num);
            echo '<label>Decimal </label><input value="'.$num.'"></input><br>';
            echo '<label>Binario </label><input value="'.$resultado.'"></input>';
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

?>
</html> 