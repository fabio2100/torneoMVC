<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>Tabla de partidos</title>
  <script src="../views/js/sorttable.js"></script>
</head>
<body>
<?php 
  echo "<table class='table table-striped table-dark table-responsive-sm sortable' align='center' border='1'><tr class='encabezado'><td>";
  echo "Día</td><td>";
  echo "Hora</td><td>";
  echo "Fecha</td><td>";
  echo "Lugar</td><td>";
  echo "Equipo</td><td>";
  echo "Gol</td><td>";
  echo "Gol</td><td>";
  echo "Equipo</td><td>";
  echo "Id </td><td>";
  echo  "Id</td></tr>"; 

  foreach($tablaPartidos as $fila){
      echo "<tr><td>";
      echo $fila["dia"] . "</td><td>";
      echo $fila["hora"] . "</td><td>";
      echo $fila["fecha"] . "</td><td>";
      echo $fila["lugar"] . "</td><td>";
      echo $fila["equipoA"] . "</td><td>";
      echo $fila["golA"] . "</td><td>";
      echo $fila["golB"] . "</td><td>";
      echo $fila["equipoB"] . "</td><td>";
      echo "<a href='../controllers/modificarPartidoControlador.php?id=".$fila['id'].   "'>"."<img class='img-responsive' src='../img/editar.png'>" ."</a></td><td>";
      echo "<a href='../controllers/eliminarPartidoControlador.php?id=".$fila['id'].   "'>"."<img class='img-responsive' src='../img/eliminar.png'>". "</a></td></tr>";
  }
  echo "</table>";
?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</html>