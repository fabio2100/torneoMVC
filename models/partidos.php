<?php
  class partidosModel{
    private $db;
    private $partido;
    private $dia;
    private $hora;
    private $fecha;
    private $equipoA;
    private $equipoB;
    private $golA;
    private $golB;

    public function __construct(){
      require_once('conexion.php');
      $this -> db = Conectar::conexion();
      $this -> partido = array();
    }

    public function getPartidos(){
      $consulta = $this -> db -> query("SELECT * FROM partidos");
      while($fila = $consulta -> fetch(PDO::FETCH_ASSOC)){
        $this -> partido[] = $fila;
      }

      return $this -> partido;
    }

    public function nuevoPartido($dia=NULL,$hora=NULL,$fecha=NULL,$lugar=null,$equipoA,$equipoB,$golA=null,$golB=null){
      try {
        $consulta = "INSERT INTO partidos (dia,hora,fecha,lugar,equipoA,equipoB,golA,golB) VALUES (:dia,:hora,:fecha,:lugar,:equipoA,:equipoB,:golA,:golB)";
        $resultado = $this -> db -> prepare($consulta);
        $resultado -> execute(array(":dia"=>$dia,":hora"=>$hora,":fecha"=>$fecha,":lugar"=>$lugar,":equipoA"=>$equipoA,":equipoB"=>$equipoB,":golA"=>$golA,":golB"=>$golB));
        $resultado -> closeCursor();
        return true;
      } catch (Exception $e) {
        echo $e-> getMessage() . $e -> getLine();
        return false;
      }
      
    }

    public function getPartido($id){
      try {
        $consulta = $this -> db -> query("SELECT * FROM partidos WHERE id = $id");
        while($fila = $consulta -> fetch(PDO::FETCH_ASSOC)){
          $consulta -> closeCursor();
          $this -> partido[] = $fila;
        }
  
        return $this -> partido;
      } catch (Exception $e) {
        echo $e -> getMessage() . "  " . $e -> getLine();
      }
    }

    public function eliminaUnPartido($id){
      $consulta = $this -> db -> query("DELETE FROM partidos WHERE id = $id");
      if ($consulta){
        $consulta -> closeCursor();
        return true;
      }else{
        return false;
      }
    }
    
  }

?>