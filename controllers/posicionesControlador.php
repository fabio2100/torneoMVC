<?php
  require_once("../models/posiciones.php");

  $equipo = new posicionesModel();

  $tablaEquipo = $equipo -> getEquipos();

  require_once("../views/equipoViews.php");

  require_once('../models/viewsFunctions.php');
  viewsFunctions::botonVolver();
?>