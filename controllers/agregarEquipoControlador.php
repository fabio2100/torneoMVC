<?php
  $equipo = $_GET['nombre'];
  require_once('../models/posiciones.php');
  $resultado = posicionesModel::agregarEquipo($equipo);
  if ($resultado){
    header("location:../public");
  }else{
    echo "Ocurrión un error";
  }
?>