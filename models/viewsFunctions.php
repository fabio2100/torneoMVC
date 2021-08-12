<?php

  class viewsFunctions{
    public static function botonVolver($link='../public/index.php'){
      echo "<div class='form-group'>";
      echo "<a href='". $link ."'>";
      echo "<button class='btn-danger form-control'>Volver</button>";
      echo "</a>";
      echo "</div>";
    }

    public static function mostrarPartidosDeUnEquipo($tablaEquipo,$equipo){
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

      foreach($tablaEquipo as $fila){
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
        echo "<a href='../controllers/eliminarPartidoControlador.php?id=".$fila['id']."&desdeEliminarEquipo=".$equipo."'><img class='img-responsive' src='../img/eliminar.png'>". "</a></td></tr>";
      }
      echo "</table>";
    }
  }
?>