<?php
  if (isset($_GET['dia'])){
    $dia = $_GET['dia'];
    if($dia==''){
      $dia = null;
    }
  }else{
    $dia = NULL;
  }
  if (isset($_GET['hora'])){
    $hora = $_GET['hora'];
    if($hora==''){
      $hora = null;
    }
  }else{
    $hora = NULL;
  }
  if (isset($_GET['fecha'])){
    $fecha = $_GET['fecha'];
    if($fecha==''){
      $fecha = null;
    }
  }else{
    $fecha = NULL;
  }
  if (isset($_GET['lugar'])){
    $lugar = $_GET['lugar'];
    if($lugar==''){
      $lugar = null;
    }
  }else{
    $lugar = NULL;
  }
  if (isset($_GET['equipoA'])){
    $equipoA = $_GET['equipoA'];
  }else{
    $equipoA = NULL;
  }
  if (isset($_GET['equipoB'])){
    $equipoB = $_GET['equipoB'];
  }else{
    $equipoB = NULL;
  }
  if (isset($_GET['golA'])){
    $golA = $_GET['golA'];
    if($golA==''){
      $golA = null;
    }else if(!is_numeric($golA) or $golA<0){
      header('location:../views/agregarPartido.php?encabezadoMismoEquipo=true');
    }
  }else{
    $golA = NULL;
  }
  if (isset($_GET['golB'])){
    $golB = $_GET['golB'];
    if($golB==''){
      $golB = null;
    }else if(!is_numeric($golB) or $golB<0){
      header('location:../views/agregarPartido.php?encabezadoMismoEquipo=true');
    }
  }else{
    $golB = NULL;
  }

  //comprobación si el usuario viene desde la página de modificar partido: Se crea variable para eliminar previamente el resultado
  if (isset($_GET['desdeModificar'])){
    $desdeModificar = true;
    $idPartido = $_GET['id'];
  }else{
    $desdeModificar = NULL;
  }
  
  if($equipoA != $equipoB){
    require_once('../models/partidos.php');
    if($desdeModificar){
      require_once('../helpers/functions.php');
      $resultadoEliminar = eliminaResultado($idPartido);
    }
    $nuevoPartido = new partidosModel();
    $resultadoPartidoInsert = $nuevoPartido -> nuevoPartido($dia,$hora,$fecha,$lugar,$equipoA,$equipoB,$golA,$golB);
    if ($resultadoPartidoInsert){
      if (is_null($golA) or is_null($golB)){
        header('location:posicionesControlador.php');
      }else{
        require_once('../models/posiciones.php');
        $res = posicionesModel::actualizaTabla($equipoA,$equipoB,$golA,$golB);
        header("location:posicionesControlador.php");
      }
    }
  }else{
    $encabezadoMismoEquipo = true;
    header('location:../views/agregarPartido.php?encabezadoMismoEquipo=true');
    //require_once('../models/viewsFunctions.php');
    //viewsFunctions::desplegarMenuMismoEquipo();
  }
?>