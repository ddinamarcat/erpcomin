<?php
include_once("ExcelToPHP.php");

/*
print_r($_FILES);
print_r($_POST);
*/

$name = $_POST['name'];
$archivo = $_POST['file'];



/*
if(move_uploaded_file($archivo,"../../docs/costo_real/".$name)){
    $msg = "subido correctamente";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}else{
    $msg = "ocurrio un error";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}*/
/*
if(isset($_POST['file'])){
    $target_dir = "../../docs/costo_real/";

    $archivo=$_POST['file'];
    $name=$_POST['name'];


    $nameLower = mb_strtolower($name,'UTF-8');
    $nombrearchivo="costo_real.xls";
    $msgArray = array();

    if(strpos($nameLower,'planilla gestion de compras')===false){
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
}else{
    $msg = "No está seteado";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}*/

?>
