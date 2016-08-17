<?php
include_once("PHPExcel.php");
include_once("PHPExcel/Calculation.php");
include_once("PHPExcel/Cell.php");
/**  Define a Read Filter class implementing PHPExcel_Reader_IReadFilter  */
class MyReadFilter implements PHPExcel_Reader_IReadFilter{
    private $_startRow = 0;
    private $_endRow   = 0;
    private $_columns  = array();

    /**  Get the list of rows and columns to read  */
    public function __construct($startRow, $endRow, $columns) {
        $this->_startRow = $startRow;
        $this->_endRow   = $endRow;
        $this->_columns  = $columns;
    }

    public function readCell($column, $row, $worksheetName = '') {
        //  Only read the rows and columns that were configured
        if ($row >= $this->_startRow && $row <= $this->_endRow) {
            if (in_array($column,$this->_columns)) {
                return true;
            }
        }
        return false;
    }

    public static function createColumnsArray($primeraCol,$ultimaCol){
        $columns = array();
        $largoPrimeraCol = strlen($primeraCol);
        $largoUltimaCol = strlen($ultimaCol);
        $firstLetterUltimaCol = substr($ultimaCol,0,1);
        $secondLetterUltimaCol = substr($ultimaCol,1,1);
        $letters = range('A','Z');
        $subletters = range('A',$secondLetterUltimaCol);


        if($largoPrimeraCol==1){
            if($largoUltimaCol==1){
                $columns = range($primeraCol, $ultimaCol);
            }elseif($largoUltimaCol==2){
                $columns = range($primeraCol,'Z');
                for($i=0; $i<count($subletters); $i++){
                    array_push($columns,$firstLetterUltimaCol.$subletters[$i]);
                }
            }
        } else{

        }

        return $columns;
    }
}

/**  Create an Instance of our Read Filter, passing in the cell range
$filterSubset = new MyReadFilter(9,15,range('G','K')); */



?>
