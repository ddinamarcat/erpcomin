<?php
class MostrarTabla{

    public static function muestraConsulta($data){
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

}

?>
