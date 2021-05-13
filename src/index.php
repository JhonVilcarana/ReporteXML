<?php

function gventas($fi, $fe, $cl) {
    $query = 'SELECT v.idventa,v.fecha,p1.dni,p1.nombres cliente,p2.nombres empleado,p.nombre,p.precio,dv.subtotal,dv.cantidad from persona p1 join venta v on (p1.idpersona=v.cliente) JOIN persona p2 on (p2.idpersona=v.empleado) join detalle_venta dv on (v.idventa=dv.idventa) join producto p on (p.idproducto=dv.idproducto) WHERE v.fecha BETWEEN "' . $fi . '" and "' . $fe . '" and p1.idpersona="' . $cl . '"';

    require "./app/connection/conexion.php";
    $resp = mysqli_query($conex, $query);
    if ($resp) {
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;
        $vents = $xml->createElement("ventas");
        $xml->appendChild($vents);
        $iv = null;

        while ($row = $resp->fetch_assoc()) {

            if ($iv) {
                if ($iv == $row['idventa']) {
                    $product = $xml->createElement("producto");
                    $products->appendChild($product);
                    $prnm = $xml->createElement("nombre", $row['nombre']);
                    $product->appendChild($prnm);
                    $punitario = $xml->createElement("punitario", $row['precio']);
                    $product->appendChild($punitario);
                    $cantidad = $xml->createElement("cantidad", $row['cantidad']);
                    $product->appendChild($cantidad);
                    $subtotal = $xml->createElement("subtotal", $row['subtotal']);
                    $product->appendChild($subtotal);

                    $iv = $row['idventa'];
                } else {
                    $iv = $row['idventa'];
                    $vent = $xml->createElement("venta");
                    $vents->appendChild($vent);
                    $fecha = $xml->createElement("fecha", $row['fecha']);
                    $vent->appendChild($fecha);
                    $empleado = $xml->createElement("empleado", $row['empleado']);
                    $vent->appendChild($empleado);
                    $products = $xml->createElement("productos");
                    $vent->appendChild($products);
                    $product = $xml->createElement("producto");
                    $products->appendChild($product);
                    $prnm = $xml->createElement("nombre", $row['nombre']);
                    $product->appendChild($prnm);
                    $punitario = $xml->createElement("punitario", $row['precio']);
                    $product->appendChild($punitario);
                    $cantidad = $xml->createElement("cantidad", $row['cantidad']);
                    $product->appendChild($cantidad);
                    $subtotal = $xml->createElement("subtotal", $row['subtotal']);
                    $product->appendChild($subtotal);
                }
            } else {
                $iv = $row['idventa'];
                $cliente = $xml->createElement("cliente", $row['cliente']);
                $vents->appendChild($cliente);
                $dni = $xml->createElement("dni", $row['dni']);
                $vents->appendChild($dni);
                $vent = $xml->createElement("venta");
                $vents->appendChild($vent);
                $fecha = $xml->createElement("fecha", $row['fecha']);
                $vent->appendChild($fecha);
                $empleado = $xml->createElement("empleado", $row['empleado']);
                $vent->appendChild($empleado);
                $products = $xml->createElement("productos");
                $vent->appendChild($products);
                $product = $xml->createElement("producto");
                $products->appendChild($product);
                $prnm = $xml->createElement("nombre", $row['nombre']);
                $product->appendChild($prnm);
                $punitario = $xml->createElement("punitario", $row['precio']);
                $product->appendChild($punitario);
                $cantidad = $xml->createElement("cantidad", $row['cantidad']);
                $product->appendChild($cantidad);
                $subtotal = $xml->createElement("subtotal", $row['subtotal']);
                $product->appendChild($subtotal);
                
            }
        }
        //       echo '<xmp>'.$xml->saveXML().'</xmp>';
        $xml->save('../out/report.xml');
    } else {
        echo "wada wadawda";
    }
}

require "./app/view/view.php"

?>