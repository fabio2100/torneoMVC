<?php

  class viewsFunctions{
    public static function botonVolver($link='../public/index.php'){
      echo "<div class='form-group'>";
      echo "<a href='". $link ."'>";
      echo "<button class='btn-danger form-control'>Volver</button>";
      echo "</a>";
      echo "</div>";
    }

  }
?>