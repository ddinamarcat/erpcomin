<?php
include_once("controllers/admin/ExcelToPHP/PHPExcel.php");
include_once("controllers/admin/ExcelToPHP/PHPExcel/Calculation.php");
include_once("controllers/admin/ExcelToPHP/PHPExcel/Cell.php");
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
var_dump($objReader);
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
$objReader->setLoadSheetsOnly(["Hoja1","Hoja2"]);
// Load $inputFileName to a PHPExcel Object
$objPHPExcel = $objReader->load($inputFileName);


var_dump($objPHPExcel);



?>
