<?php
include_once("ExcelToPHP.php");

$target_dir = "../../docs/";

$archivo=$_FILES['carga-excelreal']['tmp_name'];
$nombrearchivo="costo_real.xls";

$tipo_archivo = $_FILES['carga-excelreal']['type'];
$tamano_archivo = $_FILES['carga-excelreal']['size'];


$msg = NULL;
$msgArray = array();

if (move_uploaded_file($archivo,$target_dir.$nombrearchivo)){
	$msg = "El archivo ha sido cargado correctamente.";
    $msg2 = insertExcel($target_dir.$nombrearchivo);
    array_push($msgArray, $msg, $msg2);
    echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
}else{
	$msg = "Ocurrió algún error al subir el fichero. No pudo guardarse.";
    array_push($msgArray, $msg);
    echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
}

?>
