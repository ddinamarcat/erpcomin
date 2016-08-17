<?php
include_once("ExcelToPHP.php");

$target_dir = "../../docs/costo_real/";

$archivo=$_FILES['carga-excelreal']['tmp_name'];
$name=$_FILES['carga-excelreal']['name'];

$nameLower = mb_strtolower($name,'UTF-8');
$nombrearchivo="costo_real.xls";
$tipo_archivo = $_FILES['carga-excelreal']['type'];
$tamano_archivo = $_FILES['carga-excelreal']['size'];
$msgArray = array();

if(strpos($nameLower,'planilla gestión de compras')===false){
    $msg = "El archivo NO corresponde a la Planilla de Gesti&oacute;n de Compras";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}else{
    if (move_uploaded_file($archivo,$target_dir.$nombrearchivo)){
    	$msg = "El archivo ha sido cargado correctamente.";
        $msg2 = insertExcelReal($target_dir.$nombrearchivo);
        array_push($msgArray, $msg, $msg2);
        echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
    }else{
    	$msg = "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        array_push($msgArray, $msg);
        echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
    }
}

?>
