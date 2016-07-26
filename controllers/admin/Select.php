<?php
    include_once("MostrarTabla.php");
    $tablasel = $_POST["table"];
    $conn = mysqli_connect("localhost","cominerp2016","_ERP_COMIN16_","erpcomin");
    mysqli_set_charset($conn,"utf8");
    //$tablasel = "item";

    $query = "SELECT * FROM ".$tablasel;
    $consulta = mysqli_query($conn,$query);
    $fields = mysqli_fetch_fields($consulta);
    $num_cols = mysqli_num_fields($consulta);
    $num_rows = mysqli_num_rows($consulta);
    $i = 0;

    $fieldnames=array();
    $data = array();
    //Se agregan los nombres de las columnas

    while ($fieldinfo=mysqli_fetch_field($consulta)){
        $fieldnames[$i] = utf8_encode($fieldinfo->name);
        $i = $i + 1;
    }

    while($resultados = mysqli_fetch_array($consulta)){
            $row = array();
            for($i=0; $i<$num_cols; $i++){
                $row[] = utf8_encode($resultados[$i]);
            }
            $data[] = $row;
            unset($row);
	}

    $returned = array($fieldnames, $data);

    MostrarTabla::muestraConsulta($returned);

?>
