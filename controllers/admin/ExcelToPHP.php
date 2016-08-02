<?php
include_once("ExcelToPHP/PHPExcel.php");
include_once("ExcelToPHP/PHPExcel/Calculation.php");
include_once("ExcelToPHP/PHPExcel/Cell.php");
include_once("ExcelToPHP/MyReadFilter.php");
include_once("ExcelToPHP/configSheet.php");
include_once("CheckSerialize.php");
include_once("ToMySQL.php");

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);

$objReader->setReadDataOnly(true);


$rangeColumns = MyReadFilter::createColumnsArray($startCol,$finalCol);

$colMax = count($rangeColumns);

$filterSubset = new MyReadFilter($startRow,$finalRow,$rangeColumns);

$objReader->setLoadSheetsOnly($dataSheet);

$objReader->setReadFilter($filterSubset);

$objPHPExcel = $objReader->load($inputFileName);

/*
$sheetData = $objPHPExcel->getSheetByName($dataSheet)->getCell("N8")->getCalculatedValue();

echo $sheetData." ".getType($sheetData);*/


$sheetData = array();

for($i=1; $i<=$finalRow; $i++){
    $row = array();
    for($j=0; $j<$colMax; $j++){
        if($objPHPExcel->getSheetByName($dataSheet)->getCell($rangeColumns[$j].$i)->getDataType()=='f'){
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
    }
    array_push($sheetData,$row);
    unset($row);
}


// Se imprime el array
/*
for($i=0; $i<$finalRow; $i++){
    for($j=0; $j<$colMax; $j++){
        echo $sheetData[$i][$j]." ";
    }
    echo "<br>";
}*/




$insertSQL = new ToMySQL();

$sheetDataSQL = $insertSQL->prepararQuery($sheetData,$finalRow,$colMax);


/*
for($i=1; $i<$finalRow; $i++){
    for($j=0; $j<$colMax; $j++){
        echo $sheetDataSQL[$i][$j]." ";
    }
    echo "<br>";
}*/

$insertSQL->limpiarTablaBD();

$insertSQL->insertarDatosSheetOC($sheetData,$finalRow,$colMax);

$insertSQL->closeConnBD();



?>
