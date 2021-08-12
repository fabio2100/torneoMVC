<?php
  function dataList($tabla,$campo,$equipo=null){
    require_once('../models/conexion.php');
    $conexion = Conectar::conexion();
    $consulta = "SELECT " . $campo . " FROM " . $tabla;
    $resultado = $conexion -> query($consulta);

    //construccion de html
    if(is_null($equipo)){
      foreach($resultado as $fila){
        echo "<option value='".$fila[$campo]."'>" . $fila[$campo] . "</option>";
      }
    }else{
      foreach($resultado as $fila){
        if ($fila[$campo]==$equipo){
          echo "<option value='".$fila[$campo]."' selected>" . $fila[$campo] . "</option>";
        }else{
          echo "<option value='".$fila[$campo]."'>" . $fila[$campo] . "</option>";
        }
      }
    }
  }

  function eliminaResultado($idPartido){
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
        return true;
      }else{
        $resultadoActualizaTabla = posicionesModel::actualizaTabla($equipoA,$equipoB,$golA,$golB,1);
        if ($resultadoActualizaTabla){
          return true;
        }else{
          echo "Ocurrió un error al actualizar la tabla";
          return false;
        }
      }
    }else{
      echo "Ha ocurrido un error al eliminar el registro";
      return false;
    }
  }

?>