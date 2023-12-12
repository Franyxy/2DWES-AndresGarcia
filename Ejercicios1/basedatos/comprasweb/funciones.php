<?php
function validarNIF($nif)
    {
        $pattern = "/^[XYZ]?\d{5,8}[A-Z]$/";
        $dni = strtoupper($nif);
        if(preg_match($pattern, $dni))
        {
            $number = substr($dni, 0, -1);
            $number = str_replace('X', 0, $number);
            $number = str_replace('Y', 1, $number);
            $number = str_replace('Z', 2, $number);
            $dni = substr($dni, -1, 1);
            $start = $number % 23;
            $letter = 'TRWAGMYFPDXBNJZSQVHLCKET';
            $letter = substr('TRWAGMYFPDXBNJZSQVHLCKET', $start, 1);
            if($letter != $dni)
            {
                throw new Exception ('Caracter de Control INCORRECTO');
                return false;
            } else {
                return true;
            }
        }else{
            throw new Exception ('DNI/NIE INCORRECTO // FORMATO INCORRECTO');
            return false;
        }
    }
?>