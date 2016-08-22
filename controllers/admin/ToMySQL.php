<?php

class ToMySQL{
    public $conn;
    public $sql;
    public $datos = array(); //datos para insertar de la BD

    public function __construct(){
        $this->conn = mysqli_connect("localhost","cominerp2016","_ERP_COMIN16_","erpcomin");
        mysqli_set_charset($this->conn,"utf8");
	}

    public function backupTable($BD,$table){
        $tableData = $BD.".".$table;
        if($this->conn){
            $this->eliminarTablaBD($BD.".bckp_".$table);
            $this->sql = "CREATE TABLE ".$BD.".bckp_".$table." LIKE ".$tableData;

            if (mysqli_query($this->conn, $this->sql)) {
                $success = true;
                echo "La Tabla de Respaldo fue creada exitosamente<br><br>";
            } else {
                $success = false;
                echo "Error: no se cre&oacute; la tabla de respaldo <br><br>" . mysqli_error($this->conn);
            }

            $this->sql = "INSERT INTO ".$BD.".bckp_".$table." SELECT * FROM ".$tableData;

            if (mysqli_query($this->conn, $this->sql)) {
                $success = true;
                echo "Los datos fueron insertados exitosamente en la tabla de respaldo<br><br>";
            } else {
                $success = false;
                echo "Error: NO se insertaron los registros en la tabla de respaldo <br><br>" . mysqli_error($this->conn);
            }
        }
        return $success;
    }

    public function insertarDatosSheetOC($tableName,$headers,$datos,$rowMax,$colMax){
        if($this->conn){
            $this->sql = "INSERT INTO ".$tableName."(";
            for($i=0; $i<count($headers); $i++){
                if($i==(count($headers)-1)){
                    $this->sql .= $headers[$i].") ";
                }
                else{
                    $this->sql .= $headers[$i].",";
                }
            }
            $this->sql .= " VALUES";
            if($tableName == 'erpcomin.costoreal'){
                for($i=1; $i<$rowMax; $i++){
                    $this->sql .= "(";
                    for($j=0; $j<$colMax; $j++){
                        if($j==$colMax-1){
                            if($datos[$i][$j]=="NULL"){
                                $this->sql .= utf8_encode($datos[$i][$j]).")";
                            }else{
                                $this->sql .= "'".utf8_encode($datos[$i][$j])."')";
                            }
                        }else{
                            if($datos[$i][$j]=="NULL"){
                                $this->sql .= utf8_encode($datos[$i][$j]).",";
                            }else{
                                $this->sql .= "'".utf8_encode($datos[$i][$j])."',";
                            }
                        }
                    }
                    if($i!=$rowMax-1){
                        $this->sql .= ",";
                    }
                }

            }elseif($tableName == 'erpcomin.costooferta'){
                for($i=0; $i<$rowMax; $i++){
                    $this->sql .= "(";
                    for($j=0; $j<$colMax; $j++){
                        if($j==$colMax-1){
                            if($datos[$i][$j]=="NULL"){
                                $this->sql .= utf8_encode($datos[$i][$j]).")";
                            }else{
                                $this->sql .= "'".utf8_encode($datos[$i][$j])."')";
                            }
                        }else{
                            if($datos[$i][$j]=="NULL"){
                                $this->sql .= utf8_encode($datos[$i][$j]).",";
                            }else{
                                $this->sql .= "'".utf8_encode($datos[$i][$j])."',";
                            }
                        }
                    }
                    if($i!=$rowMax-1){
                        $this->sql .= ",";
                    }
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
            $this->sql = "DROP TABLE IF EXISTS ".$tableName;
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

            if (mysqli_query($this->conn, $this->sql)) {
                echo "La tabla ha sido CREADA <br><br>";
            } else {
                echo "Error: no se ha CREADO la tabla <br><br>" . mysqli_error($this->conn);
            }
        }
    }

    public function prepararQuery($datos,$finalRow,$colMax){
        for($i=0; $i<$finalRow; $i++){
            for($j=0; $j<$colMax; $j++){
                $datos[$i][$j] = mysqli_real_escape_string($this->conn,$datos[$i][$j]);
            }
        }

        //return $datos;
    }

    public function closeConnBD(){
        mysqli_close($this->conn);
    }
}



?>
