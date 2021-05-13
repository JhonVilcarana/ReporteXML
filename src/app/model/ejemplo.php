<?php
    require "conexion.php";
    $resp = mysqli_query($conex,"select * from alumno");
    if($resp){
        $xml = new DOMDocument("1.0");
        $xml->formatOutput=true;
        $fitness = $xml->createElement("alumnos");
        $xml->appendChild($fitness);

        while($row=mysqli_fetch_array($resp)){
            $alumno=$xml->createElement("alumno");
            $fitness->appendChild($alumno);
            $nombres=$xml->createElement("nombres",$row['nombres']);
            $alumno->appendChild($nombres);
            $apellidos=$xml->createElement("apellidos",$row['apellidos']);
            $alumno->appendChild($apellidos);
        }

        echo '<xmp>'.$xml->saveXML().'</xmp>';
        $xml->save('report.xml');

    }else{
        echo '<script>console.log("No existen respuestas");</script>';
    }
?>