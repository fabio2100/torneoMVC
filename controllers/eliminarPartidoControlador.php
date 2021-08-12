<?php
//En este controlador hay q hacer una tarea dual con ambas tablas-> eliminar el registro de partidos y además realizar el update de las tablas de posiciones
//Comenzamos con la actualización de la tabla de posiciones
  $idPartido = $_GET['id'];
  require_once('../models/partidos.php');
  $nuevoPartido = new partidosModel();
  $arrayPartido = $nuevoPartido -> getPartido($idPartido);
  $resultadoEliminarPartido = $nuevoPartido -> eliminaUnPartido($idPartido);
  if($resultadoEliminarPartido){
    require_once('../models/posiciones.php');
    foreach($arrayPartido as $fila){
      $equipoA = $fila['equipoA'];
      $equipoB = $fila['equipoB'];
      $golA = $fila['golA'];
      $golB = $fila['golB'];
    }
    if (is_null($golA) or is_null($golB)){
      if(isset($_GET['desdeEliminarEquipo'])){
        echo "sabes q ingreso";
        header("location:../controllers/eliminarEquipoControlador.php?equipoAEliminar=".$_GET['desdeEliminarEquipo']);
        //echo "location:../controllers/eliminarEquipoControlador.php?equipoAEliminar=".$_GET['desdeEliminarEquipo'];
        return null;
      }
      header("location:../controllers/partidosControlador.php");
    }else{
      $resultadoActualizaTabla = posicionesModel::actualizaTabla($equipoA,$equipoB,$golA,$golB,1);
      if ($resultadoActualizaTabla){
        if (isset($_GET['desdeEliminarEquipo'])){
          echo "sabes que también";
          header("location:../controllers/eliminarEquipoControlador.php?equipoAEliminar=".$_GET['desdeEliminarEquipo']);
          return null;
        }
        header("location:../controllers/partidosControlador.php");
      }else{
        echo "Ocurrió un error al actualizar la tabla";
      }
    }
  }else{
    echo "Ha ocurrido un error al eliminar el registro";
  }
?>