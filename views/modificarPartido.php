<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar partido</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../views/css/main.css">
</head>
<body>

  <?php
  //En este punto comprobamos si existe la variable del encabezadoMismoEquipo para definir la alerta
  if (isset($_GET['encabezadoMismoEquipo'])){
    echo "<div class='alert alert-danger' role='alert'>";
    echo  "Los equipos deben ser distintos";
    echo "</div>";
  }
  //Recuperamos la información del partido a modificar
  $idPartido = $_GET['id'];
  $golA = $fila['golA'];
  $golB = $fila['golB'];
  $equipoA = $fila['equipoA'];
  $equipoB = $fila['equipoB'];
  $dia = $fila['dia'];
  $hora = $fila['hora'];
  $lugar = $fila['lugar'];
  $fecha = $fila['fecha'];
  ?>

  <p class="h1">Modificar partido</p>
  <form  action="../controllers/agregarPartidoControlador.php" method="GET">
    <div class='form-group'>
      <select name="equipoA">   
      <?php
        require_once('../helpers/functions.php');
        dataList("posiciones","equipo",$equipoA);
      ?>
      </select>
      <input type='number' id='golA' min='0' name='golA' style='width:50px;' value='<?php echo $golA ?>'>
      <select name="equipoB">   
      <?php
        require_once('../helpers/functions.php');
        dataList("posiciones","equipo",$equipoB);
      ?>
      </select>
      <input type='number' id='golB' min='0' name='golB' style='width:50px;' value='<?php echo $golB ?>'>
    </div>
    <div class="form-group">
      <label for="dia"><input type="date" name="dia" value='<?php echo $dia ?>'></label>
      <label for="hora"><input type="time" name="hora" value='<?php echo $hora ?>'></label>
    </div>
    <div class="form-group">
      <label for="fecha">Fecha<input type="number" name="fecha" value='<?php echo $fecha ?>'></label>
      <label for="lugar">Lugar <input type="text" name="lugar" value='<?php echo $lugar ?>'></label>
    </div>
    <input type="hidden" name='desdeModificar' value="1">
    <input type="hidden" name='id' value="<?php echo $idPartido ?>">
    <div class="form-group">
      <input type="submit" value="Modificar partido" class='form-control btn-danger'>
    </div>
  </form>
  <?php
    require_once('../models/viewsFunctions.php');
    viewsFunctions::botonVolver('../controllers/partidosControlador.php');
  ?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</html>