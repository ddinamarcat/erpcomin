<?php

class ToMySQL{
    public $conn;
    public $sql;
    public $datos = array(); //datos para insertar de la BD

    public function __construct(){
        $this->conn = mysqli_connect("localhost","cominerp2016","_ERP_COMIN16_","erpcomin");
        mysqli_set_charset($this->conn,"utf8");
	}

    public function insertarDatosSheetOC($datos,$rowMax,$colMax){
        if($this->conn){
            $this->sql = "INSERT INTO erpcomin.ordendecompra(empresa,division,unidad,corroc,numoc,usuarioproc,fechaprococ,monedaorigen,monedalocal,rutproveedor,nombreproveedor,estado,lineaoc,codigoprodserv,descpprodserv,um,cantidadoc,cantrecepcionada,cantdevuelta,cantporrecepcionar,usuarioaprobacionoc,fechaaprobacionoc,valunitarionetoorigen,valtotalnetolocal,numpedidocompra,lineapedido,codigo,gpo) VALUES";
            for($i=1; $i<$rowMax; $i++){
                $this->sql .= "(";
                for($j=0; $j<$colMax; $j++){
                    if($j==$colMax-1){
                        $this->sql .= "'".utf8_encode($datos[$i][$j])."')";
                    }else{
                        $this->sql .= "'".utf8_encode($datos[$i][$j])."',";
                    }
                }
                if($i!=$rowMax-1){
                    $this->sql .= ",";
                }
            }


            if (mysqli_query($this->conn, $this->sql)) {
                echo "Los registros fueron insertados exitosamente <br><br>";
            } else {
                echo "Error: no se insertaron los registros <br><br>" . mysqli_error($this->conn);
            }
        }
    }
    public function eliminarTablaBD($tableName){
        if($this->conn){
            $this->sql = "DROP TABLE ".$tableName;
            if (mysqli_query($this->conn, $this->sql)) {
                echo "La tabla ha sido Eliminada <br><br>";
            } else {
                echo "Error: no se ha eliminado la tabla <br><br>" . mysqli_error($this->conn);
            }

        }
    }
    // Para tablas sin id
    public function crearTablaBD($headers, $typeData,$tableName){
        if($this->conn){
            $this->sql = "CREATE TABLE IF NOT EXISTS ".$tableName."(
              id INT(11) NOT NULL AUTO_INCREMENT,";
            for($i=0; $i<count($headers); $i++){
                $this->sql .= $headers[$i]." ".$typeData[$i]." DEFAULT NULL,";
            }
            $this->sql .= "PRIMARY KEY(id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
            echo $this->sql;
            /*
            if (mysqli_query($this->conn, $this->sql)) {
                echo "La tabla ha sido Eliminada <br><br>";
            } else {
                echo "Error: no se ha eliminado la tabla <br><br>" . mysqli_error($this->conn);
            }*/
        }
    }

    public function prepararQuery($datos,$finalRow,$colMax){
        for($i=0; $i<$finalRow; $i++){
            for($j=0; $j<$colMax; $j++){
                $datos[$i][$j] = mysqli_real_escape_string($this->conn,$datos[$i][$j]);
            }
        }

        return $datos;
    }

    public function closeConnBD(){
        mysqli_close($this->conn);
    }
}



?>
