<?php
include_once("ExcelToPHP.php");

if(isset($_FILES['carga-exceloferta']) && isset($_POST['ct-oferta']) && isset($_POST['mat-oferta'])){
    $target_dir_process = "../../docs/costo_oferta/temp/";
    $target_dir = "../../docs/costo_oferta/";

    $archivo=$_FILES['carga-exceloferta']['tmp_name'];
    $name=$_FILES['carga-exceloferta']['name'];
    $contrato = $_POST['ct-oferta'];

    $cod_name = substr($name,0,4);
    $contrato = $_POST['ct-oferta'];

    if($cod_name==$contrato){
        $nameLower = mb_strtolower($name,'UTF-8');
        $msgArray = array();

        if(strpos($nameLower,'pu')===true){
            if (move_uploaded_file($archivo,$target_dir.$name)){
                $msg = "El archivo <strong>".$name."</strong> ha sido cargado correctamente en el directorio <strong>".$target_dir."</strong>";
                if($contrato == "1608"){
                    $msg2 = toOferta1608Process($target_dir_process.$name, $contrato);
                }elseif($contrato == "1557"){
                    $msg2 = toOferta1557Process($target_dir_process.$name, $contrato);
                }
                array_push($msgArray, $msg, $msg2);
                echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
            }else{
                $msg = "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                array_push($msgArray, $msg);
                echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
            }
        }elseif(strpos($nameLower,'lista_items')===true){
            if (move_uploaded_file($archivo,$target_dir.$name)){
                $msg = "El archivo <strong>".$name."</strong> ha sido cargado correctamente en el directorio <strong>".$target_dir."</strong>";
                if($contrato == "1608"){
                    $msg2 = toOferta1608($target_dir.$name, $contrato);
                }elseif($contrato == "1557"){
                    $msg2 = toOferta1557($target_dir.$name, $contrato);
                }
                array_push($msgArray, $msg, $msg2);
                echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
            }else{
                $msg = "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                array_push($msgArray, $msg);
                echo json_encode($msgArray, JSON_UNESCAPED_UNICODE);
            }
        }else{
            $msg = "El archivo NO corresponde a la Planilla de Precios Unitarios de Oferta";
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        }
    }else{
        echo "El archivo no pertenece al contrato ".$contrato;
    }
}else{
    $msg = "No está seteado";
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
}

?>
