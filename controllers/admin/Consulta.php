<?php

class Consulta{
    public $conn;
    public $sql;
    public $res;
    public $tableList = array(); //tablas de la BD

    public function __construct(){
        include("config.php");
        $this->conn = mysqli_connect($hostdb,$userdb,$passdb,$namedb);
	}

    public function mostrarTablas(){
        include("config.php");
        if($this->conn){
            $this->sql = "SELECT DISTINCT descpprodserv,cantidadoc,valunitarionetoorigen"
        }

        /*
		if($this->conn){
			$this->sql = "SHOW FULL TABLES FROM ".$namedb;
            $this->res = mysqli_query($this->conn,$this->sql);
            while ($fila = mysqli_fetch_row($this->res)) {
                array_push($this->tableList, $fila[0]);
            }
            $largo = count($this->tableList);

            mysqli_close($this->conn);
            return $this->tableList;
		}*/
	}

    public function selectTabla($query){
        if($this->conn){
            $this->sql = $query;
            $consulta = mysqli_query($this->conn,$this->sql);
            mysqli_close($this->conn);
            return $consulta;
        }
    }

}

?>
