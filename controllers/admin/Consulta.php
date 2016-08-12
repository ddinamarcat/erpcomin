<?php

class Consulta{
    public $conn;
    public $sql;
    public $res;
    public $prodServ = array(); //Array con prodCod y con prodServ

    public function __construct(){
        include("config.php");
        $this->conn = mysqli_connect($hostdb,$userdb,$passdb,$namedb);
        mysqli_set_charset($this->conn,"utf8");
	}

    public function mostrarProdServ(){
        include("config.php");

        if($this->conn){
            $this->sql = "SELECT codigoproductoservicio,descripcionproductoservicio FROM erpcomin.costoreal GROUP BY codigoproductoservicio ORDER BY descripcionproductoservicio";

            $this->res = mysqli_query($this->conn,$this->sql);

            while ($fila = mysqli_fetch_row($this->res)){
                $temp = array();
                $temp[0] = utf8_decode($fila[0]);
                $temp[1] = utf8_decode($fila[1]);
                array_push($this->prodServ,$temp);
                unset($temp);

            }

            mysqli_close($this->conn);
            return $this->prodServ;

        }
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
