<?php
include_once("ExcelToPHP.php");

if(isset($_FILES['carga-excelreal']) && isset($_POST['ct-real']) && isset($_POST['mat-real'])){
    $area = NULL;
    $msgArray = array();
    switch($_POST['mat-real']){
        case "1":
            $area = "matserv";
            break;
        case "2":
            $area = "rem";
            break;
        default:
            $msg = "ERROR, no está seteado el material";
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            break;
    }

    $target_dir = "../../docs/costo_real/";

    $archivo=$_FILES['carga-excelreal']['tmp_name'];
    $name=$_FILES['carga-excelreal']['name'];

    $cod_name = substr($name,0,4);
    $contrato = $_POST['ct-real'];

    if($cod_name==$contrato){
        $nameLower = mb_strtolower($name,'UTF-8');

        if(strpos($nameLower,'planilla gestion de compras')===false){
            $msg = "El archivo NO corresponde a la Planilla de Gesti&oacute;n de Compras";
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        }else{
            if (move_uploaded_file($archivo,$target_dir.$name)){
            	$msg = "El archivo ha sido cargado correctamente.";
                $msg2 = toRealOC($target_dir.$name, $contrato, $area);
                $msg3 = toRealSC($target_dir.$name, $contrato, $area);
                array_push($msgArray, $msg, $msg2, $msg3);
                echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
            }else{
            	$msg = "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                array_push($msgArray, $msg);
                echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
            }
        }
    }else{
        echo "El archivo subido no pertenece al contrato ".$contrato;
    }
}else{
    $msg = "No está seteado";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}

?>
