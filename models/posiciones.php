<?php
  class posicionesModel{
    private $db;
    private $id;
    private $equipo;
    private $pj;
    private $pg;
    private $pe;
    private $pp;
    private $ptos;
    private $gf;
    private $gc;
    private $dif;

    public function __construct(){
      require_once('conexion.php');
      $this -> db = Conectar::conexion();
      $this -> equipo =  array();
    }

    public function getEquipos(){
      $consulta = $this -> db -> query("SELECT * FROM posiciones ORDER BY ptos DESC,dif DESC");
      while($fila = $consulta -> fetch(PDO::FETCH_ASSOC)){
        $this -> equipo[] = $fila;
      }

      return $this -> equipo;
    }

    public static function agregarEquipo($nombre){
      try {
        require_once('conexion.php');
        $conexion = Conectar::conexion();
        $consulta = "INSERT INTO  posiciones (equipo,pj,pg,pe,pp,ptos,gf,gc,dif) VALUES (:equipo,0,0,0,0,0,0,0,0)";
        $resultadoInsertarEquipo = $conexion -> prepare($consulta);
        $resultadoInsertarEquipo -> execute(array(":equipo"=>$nombre));
        $resultadoInsertarEquipo -> closeCursor();
        return true;
      } catch (Exception $e) {
        echo $e->getMessage() . $e-> getLine();
        return false;
      }
    }

    public static function actualizaTabla($equipoA,$equipoB,$golA,$golB,$insODel=0){
      
      if ($golA > $golB){
        $equipoGanador = $equipoA;
        $equipoPerdedor = $equipoB;
        $golGanador = $golA;
        $golPerdedor = $golB;
      }else if($golB > $golA){
        $equipoGanador = $equipoB;
        $equipoPerdedor = $equipoA;
        $golGanador = $golB;
        $golPerdedor = $golA;
      }else if($golA == $golB){
        $equipoGanador = $equipoA;
        $equipoPerdedor = $equipoB;
        $golGanador = $golA;
        $golPerdedor = $golB;
        try {
          require_once('conexion.php');
          $conexion = Conectar::conexion();
          //Actualización del equipo ganador
          $sqlG = "SELECT * FROM posiciones WHERE equipo = '$equipoGanador'";
          $resG = $conexion -> prepare($sqlG);
          $resG -> execute();
          foreach($resG as $fila){
            $pgG = $fila['pg'];
            $ppG = $fila['pp'];
            $peG = $fila['pe'];
            $gfG = $fila['gf'];
            $gcG = $fila['gc'];
          }
          $resG -> closeCursor();
          if($insODel==0){
            $peG ++;
            $gfG = $gfG + $golGanador;
            $gcG = $gcG + $golPerdedor;
          }else if($insODel==1){
            $peG --;
            $gfG = $gfG - $golGanador;
            $gcG = $gcG - $golPerdedor;
          }
          $pjG = $pgG + $peG + $ppG;
          $ptosG = 3 * $pgG + $peG;
          
          $difG = $gfG - $gcG;
          $actualizaGanador = "UPDATE posiciones SET pj = :pj, pg = :pg, pe = :pe , pp = :pp, ptos = :ptos, gf = :gf, gc = :gc, dif = :dif WHERE equipo = '$equipoGanador'";
          $resultadoActualiza = $conexion -> prepare($actualizaGanador);
          $resultadoActualiza -> execute(array(":pj"=>$pjG,":pg"=>$pgG,":pe"=>$peG,":pp"=>$ppG,":ptos"=>$ptosG,":gf"=>$gfG,":gc"=>$gcG,":dif"=>$difG));
          $resultadoActualiza -> closeCursor();
          //Actualización del equipo perdedor
          $sqlP = "SELECT * FROM posiciones WHERE equipo = '$equipoPerdedor'";
          $resP = $conexion -> prepare($sqlP);
          $resP -> execute();
          foreach($resP as $fila){
            $pgP = $fila['pg'];
            $ppP = $fila['pp'];
            $peP = $fila['pe'];
            $gfP = $fila['gf'];
            $gcP = $fila['gc'];
          }
          $resP -> closeCursor();
          if($insODel==0){
            $peP ++;
            $gfP = $gfP + $golPerdedor;
            $gcP = $gcP + $golGanador;
          }else if($insODel==1){
            $peP --;
            $gfP = $gfP - $golPerdedor;
            $gcP = $gcP - $golGanador;
          }
          $pjP = $pgP + $peP + $ppP;
          $ptosP = 3 * $pgP + $peP;
          $difP = $gfP - $gcP;
          $actualizaPerdedor = "UPDATE posiciones SET pj = :pj, pg = :pg, pe = :pe , pp = :pp, ptos = :ptos, gf = :gf, gc = :gc, dif = :dif WHERE equipo = '$equipoPerdedor'";
          $resultadoActualizaP = $conexion -> prepare($actualizaPerdedor);
          $resultadoActualizaP -> execute(array(":pj"=>$pjP,":pg"=>$pgP,":pe"=>$peP,":pp"=>$ppP,":ptos"=>$ptosP,":gf"=>$gfP,":gc"=>$gcP,":dif"=>$difP));
          $resultadoActualizaP -> closeCursor();
          return true;
        } catch (Exception $e) {
          echo $e -> getMessage() . $e -> getLine();
          return false;
        }
      }
      try {
        require_once('conexion.php');
        $conexion = Conectar::conexion();
        //Actualización del equipo ganador
        $sqlG = "SELECT * FROM posiciones WHERE equipo = '$equipoGanador'";
        $resG = $conexion -> prepare($sqlG);
        $resG -> execute();
        foreach($resG as $fila){
          $pgG = $fila['pg'];
          $ppG = $fila['pp'];
          $peG = $fila['pe'];
          $gfG = $fila['gf'];
          $gcG = $fila['gc'];
        }
        $resG -> closeCursor();
        if ($insODel == 0){
          $pgG ++;
          $gfG = $gfG + $golGanador;
          $gcG = $gcG + $golPerdedor;
        }else if($insODel == 1){
          $pgG --;
          $gfG = $gfG - $golGanador;
          $gcG = $gcG - $golPerdedor;
        }
        $pjG = $pgG + $peG + $ppG;
        $ptosG = 3 * $pgG + $peG;
        $difG = $gfG - $gcG;
        $actualizaGanador = "UPDATE posiciones SET pj = :pj, pg = :pg, pe = :pe , pp = :pp, ptos = :ptos, gf = :gf, gc = :gc, dif = :dif WHERE equipo = '$equipoGanador'";
        $resultadoActualiza = $conexion -> prepare($actualizaGanador);
        $resultadoActualiza -> execute(array(":pj"=>$pjG,":pg"=>$pgG,":pe"=>$peG,":pp"=>$ppG,":ptos"=>$ptosG,":gf"=>$gfG,":gc"=>$gcG,":dif"=>$difG));
        $resultadoActualiza -> closeCursor();
        //Actualización del equipo perdedor
        $sqlP = "SELECT * FROM posiciones WHERE equipo = '$equipoPerdedor'";
        $resP = $conexion -> prepare($sqlP);
        $resP -> execute();
        foreach($resP as $fila){
          $pgP = $fila['pg'];
          $ppP = $fila['pp'];
          $peP = $fila['pe'];
          $gfP = $fila['gf'];
          $gcP = $fila['gc'];
        }
        $resP -> closeCursor();
        if($insODel == 0){
          $ppP ++;
          $gfP = $gfP + $golPerdedor;
          $gcP = $gcP + $golGanador;
        }else if($insODel == 1){
          $ppP --;
          $gfP = $gfP - $golPerdedor;
          $gcP = $gcP - $golGanador;
        }
        $pjP = $pgP + $peP + $ppP;
        $ptosP = 3 * $pgP + $peP;
        $difP = $gfP - $gcP;
        $actualizaPerdedor = "UPDATE posiciones SET pj = :pj, pg = :pg, pe = :pe , pp = :pp, ptos = :ptos, gf = :gf, gc = :gc, dif = :dif WHERE equipo = '$equipoPerdedor'";
        $resultadoActualizaP = $conexion -> prepare($actualizaPerdedor);
        $resultadoActualizaP -> execute(array(":pj"=>$pjP,":pg"=>$pgP,":pe"=>$peP,":pp"=>$ppP,":ptos"=>$ptosP,":gf"=>$gfP,":gc"=>$gcP,":dif"=>$difP));
        $resultadoActualizaP -> closeCursor();
        return true;
      } catch (Exception $e) {
        echo $e -> getMessage() . $e -> getLine();
        return false;
      }
      
    }


  }

?>