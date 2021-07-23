<?php
  $id = $_GET['id'];
  require_once('../models/partidos.php');
  $nuevoPartido = new partidosModel();
  $arrayPartidoAModificar = $nuevoPartido -> getPartido($id);
  foreach($arrayPartidoAModificar as $fila){
  }
  require_once('../views/modificarPartido.php');
?>