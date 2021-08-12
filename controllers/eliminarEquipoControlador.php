<?php 
  require_once('../views/eliminarEquipoView.php');
  if (isset($_GET['equipoAEliminar'])){
    $equipo = $_GET['equipoAEliminar'];
    require_once('../models/partidos.php');
    $nuevoPartidos = new partidosModel();
    $tablaPartidosEquipo = $nuevoPartidos -> getPartidosEquipo($equipo);
    if (count($tablaPartidosEquipo)>0){
      echo "<div class='alert alert-danger' role='alert'>";
      echo  "Antes debe eliminar todos los partidos de " . strtoupper($equipo);
      echo "</div>";
      require_once('../models/viewsFunctions.php');
      viewsFunctions::mostrarPartidosDeUnEquipo($tablaPartidosEquipo,$equipo);
    }else{
      require_once('../models/posiciones.php');
      $resultado = posicionesModel::eliminarEquipo($equipo);
      if ($resultado){
        header('location:../public/index.php');
      }else{
        echo "Ha ocorrido un error";
      }
    }
  }
?>