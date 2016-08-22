<?php
include_once("ExcelToPHP.php");

$target_dir = "../../docs/costo_oferta/";

$archivo=$_FILES['carga-exceloferta']['tmp_name'];
$name=$_FILES['carga-exceloferta']['name'];
$nameLower = mb_strtolower($name,'UTF-8');
$contrato = intval(substr($nameLower,0,4));
$nombrearchivo="pu_costo_oferta.xls";
$tipo_archivo = $_FILES['carga-exceloferta']['type'];
$tamano_archivo = $_FILES['carga-exceloferta']['size'];
$msgArray = array();

if(strpos($nameLower,'pu editables proyecto cmpc')===false){
    $msg = "El archivo NO corresponde a la Planilla PU del contrato ".$contrato;
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}else{
    if (move_uploaded_file($archivo,$target_dir.$nombrearchivo)){
    	$msg = "El archivo ha sido cargado correctamente.";
        $msg2 = insertExcelOferta($target_dir.$nombrearchivo);
        array_push($msgArray, $msg, $msg2);
        echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
    }else{
    	$msg = "Ocurrió alg&uacute;n error al subir el fichero. No pudo guardarse.";
        array_push($msgArray, $msg);
        echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
    }
}

?>
