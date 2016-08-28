<?php
include_once("ExcelToPHP.php");

$target_dir = "../../docs/transform/";

$archivo=$_FILES['report1608-toexcel']['tmp_name'];
$name=$_FILES['report1608-toexcel']['name'];

$nameLower = mb_strtolower($name,'UTF-8');
$nombrearchivo="transform1608.xls";
$tipo_archivo = $_FILES['report1608-toexcel']['type'];
$tamano_archivo = $_FILES['report1608-toexcel']['size'];
$msgArray = array();

if(strpos($nameLower,'pu_1608_cmpc')===false){
    $msg = "El archivo NO corresponde a la Planilla de Precio Unitario del contrato 1608";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}else{
    if (move_uploaded_file($archivo,$target_dir.$nombrearchivo)){
    	$msg = "El archivo ha sido cargado correctamente.";
        $msg2 = toTable1608($target_dir.$nombrearchivo);
        array_push($msgArray, $msg, $msg2);
        echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
    }else{
    	$msg = "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        array_push($msgArray, $msg);
        echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
    }
}


?>
