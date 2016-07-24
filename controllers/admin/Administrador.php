<?php
class Administrador extends Usuario{
    public function __construct(){
        $this->bdd = $this->conectar();
	}

    public function mostrarTablas(){
        global $namedb;
		if($this->bdd->conectar()){
			$sql = "SHOW FULL TABLES FROM ".$namedb;
			$tdp = null;
			$parametros = null;
			$campos = array();
			$r = $this->bdd->ejecutar($sql,$parametros,$tdp,$campos[0],$campos[1],$campos[2],$campos[3],$campos[4], $campos[5]);
			if(count($r)!=0){
				return $r;
			}
			else{
				return false;
			}
		}
	}

}




?>
