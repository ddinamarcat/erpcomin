<?php
include_once("ExcelToPHP/PHPExcel.php");
include_once("ExcelToPHP/PHPExcel/Calculation.php");
include_once("ExcelToPHP/PHPExcel/Cell.php");
include_once("ExcelToPHP/MyReadFilter.php");
include_once("../../lib/SanearString.php");
include_once("CheckSerialize.php");
include_once("ToMySQL.php");

function insertExcelReal($inputFileName){
    $startRow = 1;
    $startCol = 'A';
    $dataSheet = "Orden de Compra";
    $BD = "erpcomin";
    $table = "costoreal";
    $BDtableName = $BD.".".$table;

    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setReadDataOnly(true);
    $objReader->setLoadSheetsOnly($dataSheet);

    $objPHPExcel = $objReader->load($inputFileName);

    $finalRow = $objPHPExcel->getSheetByName($dataSheet)->getHighestRow();
    $finalCol = $objPHPExcel->getSheetByName($dataSheet)->getHighestColumn();

    $rangeColumns = MyReadFilter::createColumnsArray($startCol,$finalCol);

    $colMax = count($rangeColumns);

    $filterSubset = new MyReadFilter($startRow,$finalRow,$rangeColumns);

    $objReader->setReadFilter($filterSubset);



    //Documentacion
    /*$sheetData = $objPHPExcel->getSheetByName($dataSheet)->getCell("N8")->getCalculatedValue();

    echo $sheetData." ".getType($sheetData);*/


    $sheetData = array();
    $headers = array();
    $dTypetemp = array();

    for($i=1; $i<=$finalRow; $i++){
        $daType = array();
        $row = array();
        for($j=0; $j<$colMax; $j++){
            $typ = NULL;
            $typ = $objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getDataType();
            array_push($daType,$typ);

            if($typ=='f'){
                $realCell = array();
                array_push($realCell,$objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getOldCalculatedValue());
                array_push($realCell,$objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue());
                $serCell = serialize($realCell);
                array_push($row,$serCell);
                unset($serCell);
                unset($realCell);
            } else{
                array_push($row,$objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue());
            }
            unset($typ);
        }
        array_push($dTypetemp,$daType);
        array_push($sheetData,$row);
        unset($row);
        unset($daType);
    }

    // Capturing and form headers
    for($j=0; $j<$colMax; $j++){
        array_push($headers,$objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].'1')->getValue());
    }

    // Constructing headers well formed, without spaces and rare characters
    $wellHeaders = array();
    for($j=0; $j<count($headers); $j++){
        $temp = NULL;
        $temp2 = NULL;
        $temp = mb_strtolower($headers[$j],'UTF-8');
        $temp2 = sanear_string($temp);
        array_push($wellHeaders,$temp2);
        unset($temp);
        unset($temp2);
    }

    $testCol = 0;
    $testRow = 0;

    $typeData = array();

    // Almacena los tipos de datos y detecta si los numeros son enteros o flotantes
    for($j=0; $j<$colMax; $j++){
        $encontrado = NULL;
        $i = 0;


        while($encontrado!='FLOAT'){
            if($dTypetemp[$i][$j]=='n'){
                $numChar = strval($objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue());
                if(strpos($numChar,'.')==true){
                    $encontrado = 'FLOAT';
                }else{
                    $encontrado= 'INT';
                }
            }elseif($dTypetemp[$i][$j]=='s'){
                $encontrado = 'VARCHAR(255)';
            }elseif($dTypetemp[$i][$j]=='e'){
                $encontrado = 'VARCHAR(255)';
            }elseif($dTypetemp[$i][$j]=='b'){
                $encontrado= 'TINYINT(1)';
            }elseif($dTypetemp[$i][$j]=='f'){
                $encontrado= 'VARCHAR(512)';
            }
            $i = $i + 1;
            if($i == $finalRow){
                break;
            }
        }
        array_push($typeData, $encontrado);
        unset($i);
        unset($encontrado);
    }



    // Documentacion: Se imprime el array
    /*
    for($i=0; $i<$finalRow; $i++){
        for($j=0; $j<$colMax; $j++){
            echo $sheetData[$i][$j]." ";
        }
        echo "<br>";
    }*/

    /*


    */


    // Documentacion
    /*for($i=1; $i<$finalRow; $i++){
        for($j=0; $j<$colMax; $j++){
            echo $sheetDataSQL[$i][$j]." ";
        }
        echo "<br>";
    }*/

    $insertSQL = new ToMySQL();

    $insertSQL->backupTable($BD,$table);

    $insertSQL->eliminarTablaBD($BDtableName);

    $insertSQL->crearTablaBD($wellHeaders,$typeData,$BDtableName);


    $sheetDataSQL = $insertSQL->prepararQuery($sheetData,$finalRow,$colMax);

    $insertSQL->insertarDatosSheetOC($BDtableName,$wellHeaders,$sheetData,$finalRow,$colMax);

    $insertSQL->closeConnBD();

    $msg = "Excel correctamente vaciado en la base de datos.";

    return $msg;

}

function insertExcelOferta($inputFileName){
    $startRow = 1;
    $startCol = 'A';
    $dataSheet = "PU";
    $BD = "erpcomin";
    $table = "costooferta";
    $BDtableName = $BD.".".$table;

    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setReadDataOnly(true);
    $objReader->setLoadSheetsOnly($dataSheet);

    $objPHPExcel = $objReader->load($inputFileName);

    $finalRow = $objPHPExcel->getSheetByName($dataSheet)->getHighestRow();
    //$finalCol = $objPHPExcel->getSheetByName($dataSheet)->getHighestColumn();
    $finalCol = 'G';


    $rangeColumns = MyReadFilter::createColumnsArray($startCol,$finalCol);

    $colMax = count($rangeColumns);


    $filterSubset = new MyReadFilter($startRow,$finalRow,$rangeColumns);

    $objReader->setReadFilter($filterSubset);



    //Documentacion
    /*$sheetData = $objPHPExcel->getSheetByName($dataSheet)->getCell("N8")->getCalculatedValue();

    echo $sheetData." ".getType($sheetData);*/


    $sheetData = array();
    $headers = array();

    // Obtención de headers
    for($i=0; $i<$finalRow; $i++){
        if($objPHPExcel->getSheetByName($dataSheet)->getCell('A'.$i)->getValue() == 'Código'){
            for($j=0; $j<$colMax; $j++){
                if($objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue()!=NULL){
                    array_push($headers,$objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue());
                }
            }
            break;
        }
    }


    for($i=0; $i<$finalRow; $i++){
        if($objPHPExcel->getSheetByName($dataSheet)->getCell('A'.$i)->getValue() == 'Código'){
            $i = $i + 3;
            if($objPHPExcel->getSheetByName($dataSheet)->getCell('A'.$i)->getValue() != NULL){
                while($objPHPExcel->getSheetByName($dataSheet)->getCell('A'.$i)->getValue() != NULL){
                    //echo "Fila: ".$i." - ".$objPHPExcel->getSheetByName($dataSheet)->getCell('A'.$i)->getValue()."<br>";
                    $row = array();
                    for($j=0; $j<$colMax; $j++){
                        if($objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue()==NULL){
                            array_push($row, "NULL");
                        }else{
                            array_push($row,$objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue());
                        }
                        if($j==1){
                            $j = $j + 1;
                        }
                    }
                    array_push($sheetData,$row);
                    unset($row);
                    $i = $i + 1;
                }
            }
        }
    }

    unset($finalRow);
    $colMax = $colMax - 1;
    $finalRow = count($sheetData);

    // Imprimir dataSheet
    /*
    for($i=0; $i<$finalRow; $i++){
        for($j=0; $j<$colMax; $j++){
            echo $sheetData[$i][$j]." ";
        }
        echo "<br>";
    }*/

    // Constructing headers well formed, without spaces and rare characters
    $wellHeaders = array();
    for($j=0; $j<count($headers); $j++){
        $temp = NULL;
        $temp2 = NULL;
        $temp = mb_strtolower($headers[$j],'UTF-8');
        $temp2 = sanear_string($temp);
        array_push($wellHeaders,$temp2);
        unset($temp);
        unset($temp2);
    }
    // Se imprimen los headers
    /*for($i=0; $i<count($wellHeaders); $i++){
        echo $wellHeaders[$i]." ";
    }*/


    $typeData = ['VARCHAR(255)','VARCHAR(255)','VARCHAR(255)','FLOAT','FLOAT','FLOAT'];



    $insertSQL = new ToMySQL();

    $insertSQL->backupTable($BD,$table);

    $sheetDataSQL = $insertSQL->prepararQuery($sheetData,$finalRow,$colMax);

    $insertSQL->eliminarTablaBD($BDtableName);

    $insertSQL->crearTablaBD($wellHeaders,$typeData,$BDtableName);

    $insertSQL->insertarDatosSheetOC($BDtableName,$wellHeaders,$sheetData,$finalRow,$colMax);

    $insertSQL->closeConnBD();

    $msg = "Excel correctamente vaciado en la base de datos.";

    return $msg;
}

function toTable1608($inputFileName){
    $startRow = 1;
    $startCol = 'C';
    $dataSheet = "Hoja1";
    $BD = "erpcomin";
    $table = "costooferta";
    $BDtableName = $BD.".".$table;

    $target_dir = "../../docs/";

    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setReadDataOnly(true);
    $objReader->setLoadSheetsOnly($dataSheet);

    $objPHPExcel = $objReader->load($inputFileName);

    //$finalRow = 912;
    $finalRow = $objPHPExcel->getSheetByName($dataSheet)->getHighestRow();
    //$finalCol = $objPHPExcel->getSheetByName($dataSheet)->getHighestColumn();
    $finalCol = 'G';


    $rangeColumns = MyReadFilter::createColumnsArray($startCol,$finalCol);

    $colMax = count($rangeColumns);
    $row = array();
    $sheetData = array();
    $contador = 0;
    $token = false;

    for($i=1; $i<$finalRow+1; $i++){
        $posSgte = $i + 1;
        if($objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[0].$i)->getValue()=="CATEGORIA" || $token===true){
            if($objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[0].$posSgte)->getValue()!=NULL || $token ===true){
                $row = array();
                if($token===true){
                    for($j=0; $j<$colMax; $j++){
                        array_push($row,$objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue());
                    }
                    if($objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[0].$posSgte)->getValue()===NULL){
                        $token = false;
                    }
                }else{
                    $i = $i + 1;
                    $posSgte = $i + 1;
                    for($j=0; $j<$colMax; $j++){
                        array_push($row,$objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getValue());
                    }
                    if($objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[0].$posSgte)->getValue()!=NULL){
                        $token = true;
                    }else{
                        $token = false;
                    }
                }
            }else{
                $token = false;
            }

            if(!empty($row)){
                array_push($sheetData,$row);
                unset($row);
            }
        }
    }

    /*
    for($i=0; $i<count($sheetData); $i++){
        for($j=0; $j<$colMax; $j++){
            echo $sheetData[$i][$j]." ";
        }
        echo "<br>";
    }*/

    $objPHPExcel->getProperties()->setCreator("COMIN")
                             ->setLastModifiedBy("29-08-2016")
                             ->setTitle("PU")
                             ->setSubject("PU_1608")
                             ->setDescription("Planilla obtenida desde reporte")
                             ->setKeywords("PU_codigos")
                             ->setCategory("Tabla_PU_Informe15");

    for($i=0; $i<count($sheetData); $i++){
        for($j=0; $j<$colMax; $j++){
            //echo $rangeColumns[$j].($i+1).": ".$sheetData[$i][$j]." ";

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($rangeColumns[$j].($i+1), $sheetData[$i][$j]);

        }
    }

    header('Content-Type: application/vnd.ms-excel');
    //header('Content-Disposition: attachment;filename="listproduct.xls"');
    header ('Cache-Control: cache, must-revalidate');
    header ('Pragma: public');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save($target_dir."/PU_1608.xls");

}


?>
