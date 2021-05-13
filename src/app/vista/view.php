<?php

if (isset($_POST['submit'])) {
  $fini = $_POST['fini'];
  $fend = $_POST['fend'];
  $client = $_POST['client'];
  gventas($fini, $fend, $client);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../libraries/bootstrap.min.css">

</head>

<body>
  <div class="container">
    <form method="POST">
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="fini" class="form-label">Fecha de inicio</label>
            <input type="date" class="form-control" id="fini" aria-describedby="emailHelp" name="fini" required>
          </div>
        </div>
        <div class="col">
          <div class="mb-3">
            <label for="fend" class="form-label">Fecha final</label>
            <input type="date" class="form-control" id="fend" name="fend" required>
          </div>
        </div>
        <div class="col">
          <div class="mb-3">
            <label for="client" class="form-label">Cliente</label>
            <select type="text" class="form-control" id="client" name="client" required>
              <option value="0" default>Seleccione cliente</option>
              <?php
              require "./app/connection/conexion.php";
              $resp = mysqli_query($conex, 'select * from persona where idrol=1');
              while ($row = $resp->fetch_assoc()) {
                echo "<option value='" . $row['idpersona'] . "'>" . $row['nombres'] . "</option>";
              }

              ?>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit" onclick="">Generar</button>
      </div>
    </form>
    <div class="row">
      <div class="col">
      </div>
      <div class="col" style="text-align: center;">
        <?php 

        if (isset($_POST['submit'])){
          echo "<a download='report.xml'class='btn btn-primary' href='../out/report.xml'>Descargar reporte</a>";
        }
        ?>
      </div>
      <div class="col">
      </div>
    </div>

  </div>

  <script src="../libraries/bootstrap.bundle.min.js"></script>
</body>

</html>