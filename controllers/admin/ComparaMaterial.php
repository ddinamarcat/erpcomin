<?php
include_once("MostrarTabla.php");
if(isset($_POST["codigomat"])){
    $tablasel = "erpcomin.costoreal";
    $tablasel2 = "erpcomin.costooferta";
    $codigomat = $_POST["codigomat"];
    $conn = mysqli_connect("localhost","cominerp2016","_ERP_COMIN16_","erpcomin");
    mysqli_set_charset($conn,"utf8");
    //$codigomat = "101010006";

    $query = "SELECT codigoproductoservicio,descripcionproductoservicio,cantidadoc,valorunitarionetoorigen FROM ".$tablasel." WHERE codigoproductoservicio='".$codigomat."'";

    $consulta = mysqli_query($conn,$query);

    $dataLocal = array();
    $fieldnames=array();
    $dataOriginal = array();

    $i = 0;

    while ($fieldinfo=mysqli_fetch_field($consulta)){
        $fieldnames[$i] = utf8_encode($fieldinfo->name);
        $i = $i + 1;
    }

    $num_cols = count($fieldnames);


    while($resultados = mysqli_fetch_array($consulta)){
        $row = array();
        for($i=0; $i<$num_cols; $i++){
            $row[] = utf8_decode($resultados[$i]);
        }
        array_push($dataOriginal,$row);
        unset($row);
    }

    $query2 = "SELECT codigoprodserv,descpprodserv,cantidadoc,valunitarionetoorigen FROM ".$tablasel2." WHERE codigoprodserv='".$codigomat."'";


    if($consulta2 = mysqli_query($conn,$query2)){

        $num_cols2 = mysqli_num_fields($consulta2);
        $j = 0;


        while($resultados2 = mysqli_fetch_array($consulta2)){
            $row2 = array();
            for($i=0; $i<$num_cols2; $i++){
                $row2[] = utf8_decode($resultados2[$i]);
            }
            $dataLocal[] = $row2;
            unset($row2);
        }

    }

    $returned = array($fieldnames, $dataOriginal,$dataLocal);
    MostrarTabla::muestraConsulta($returned);
    unset($returned);
    mysqli_close($conn);

}
?>
