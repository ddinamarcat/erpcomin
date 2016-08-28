<?php

class Consulta{
    public $conn;
    public $sql;
    public $res;
    public $contrato = array(); //Array con los contratos
    public $prodServ = array(); //Array con prodCod y con prodServ

    public function __construct(){
        include("config.php");
        $this->conn = mysqli_connect($hostdb,$userdb,$passdb,$namedb);
        mysqli_set_charset($this->conn,"utf8");
	}

    public function mostrarContratos(){
        include("config.php");
        if($this->conn){
            $this->sql = "SELECT codigo,nombre FROM erpcomin.contrato ORDER BY codigo";
            $this->res = mysqli_query($this->conn,$this->sql);

            if($this->res == false){
                echo("Error description: " . mysqli_error($this->conn));
            }else{
                while ($fila = mysqli_fetch_row($this->res)){
                    $temp = array();
                    $temp[0] = utf8_decode($fila[0]);
                    $temp[1] = utf8_decode($fila[1]);
                    array_push($this->contrato,$temp);
                    unset($temp);
                }

                mysqli_close($this->conn);
                return $this->contrato;
            }
        }
    }

    public function IngresarContrato($codigo,$nombre){
        if($this->conn){
            $this->sql = "INSERT INTO erpcomin.contrato(codigo,nombre) VALUES('".$codigo."','".$nombre."')";
            $this->res = mysqli_query($this->conn,$this->sql);
            if($this->res == false){
                echo("Error description: " . mysqli_error($this->conn));
            }else{
                echo("Se inserto exitosamente el contrato");
                mysqli_close($this->conn);
            }

        }
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
