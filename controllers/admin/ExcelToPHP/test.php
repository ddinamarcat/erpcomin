<?php
ini_set("max_execution_time", 300);
ini_set("memory_limit","500M");
include_once("PHPExcel.php");
include_once("PHPExcel/Calculation.php");
include_once("PHPExcel/Cell.php");
include_once("chunkReadFilter.php");
include_once("config.php");

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);

$objReader->setReadDataOnly(true);

$chunkFilter = new chunkReadFilter();

$objReader->setReadFilter($chunkFilter);

for ($startRow = 2; $startRow <= 3000; $startRow += $chunkSize) {
    /**  Tell the Read Filter, the limits on which rows we want to read this iteration  **/
    $chunkFilter->setRows($startRow,$chunkSize);
    /**  Load only the rows that match our filter from $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($inputFileName);
    //    Do some processing here
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    //    Free up some of the memory
    $objPHPExcel->disconnectWorksheets();
    unset($objPHPExcel);
}

var_dump($sheetData);

?>
