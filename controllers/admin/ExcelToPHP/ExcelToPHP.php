<?php
include_once("PHPExcel.php");
include_once("PHPExcel/Calculation.php");
include_once("PHPExcel/Cell.php");

//Se define la ruta del archivo excel
$inputFileName = '../../../docs/ejerc1.xlsx';
//Se detecta el tipo de archivo
//    $inputFileType = 'Excel5';
//    $inputFileType = 'Excel2007';
//    $inputFileType = 'Excel2003XML';
//    $inputFileType = 'OOCalc';
//    $inputFileType = 'SYLK';
//    $inputFileType = 'Gnumeric';
//    $inputFileType = 'CSV';
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
// Create a new Reader of the type defined in $inputFileType
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
// Advise the Reader that we only want to load cell data
$objReader->setReadDataOnly(true);
// Se cargan solamente las hojas requeridas
/* Si se quiere cargar solamente la hoja activa y pasarla de inmediato a un array:
   $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
   Si quiero cargar varias hojas debo pasarle un array. Ej:
   $sheetnames = array('Data Sheet #1','Data Sheet #3');
   $objReader->setLoadSheetsOnly($sheetnames);

   To reset this option to the default, you can call the setLoadAllSheets() method
*/
$objReader->setLoadSheetsOnly("Hoja1");
// Load $inputFileName to a PHPExcel Object
$objPHPExcel = $objReader->load($inputFileName);
//$sheet = $objPHPExcel->getSheetByName("Hoja1");
$rowIterator = $objPHPExcel->getSheetByName("Hoja1")->getRowIterator();

$array_data = array();

foreach($rowIterator as $row){
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
    //if(1 == $row->getRowIndex ()) continue;//skip first row
    $rowIndex = $row->getRowIndex ();
    $array_data[$rowIndex] = array('A'=>'', 'B'=>'','C'=>'','D'=>'');

    foreach ($cellIterator as $cell) {
        if('A' == $cell->getColumn()){
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        } else if('B' == $cell->getColumn()){
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        } else if('C' == $cell->getColumn()){
            $array_data[$rowIndex][$cell->getColumn()] = PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
        } else if('D' == $cell->getColumn()){
            $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
        }
    }
}
print $array_data[1];




?>
