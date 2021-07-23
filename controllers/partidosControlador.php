<?php
  require_once('../models/partidos.php');
  $partido = new partidosModel();
  $tablaPartidos = $partido -> getPartidos();
  require_once('../views/partidoView.php');
  require_once('../models/viewsFunctions.php');
  viewsFunctions::botonVolver();
?>