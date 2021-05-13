<?php
    $conex = new mysqli("localhost","root","root","test");
    if ($conex->connect_errno){
        die("error");
    } else{
        echo '<script>console.log("conexion exitosa");</script>';
    }
    
?>