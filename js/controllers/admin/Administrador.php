<?php
class Administrador extends Usuario{
    public function __construct(){
        $this->bdd = $this->conectar();
	}

    public function getListaEventos(){
        global $namedb;
		if($this->bdd->conectar()){
			$sql = "SELECT idevento, inicio, fin, urlimagenhome, urlthumbnail, urlafiche, titulo, descripcion, participantes, urlinscripcion, idioma, precio, cupos, organizado, destacado FROM ".$namedb.".vista_eventos";
			$tdp = null;
			$parametros = null;
			$campos = array('idevento', 'inicio', 'fin', 'urlimagenhome', 'urlthumbnail', 'urlafiche', 'titulo', 'descripcion', 'participantes', 'urlinscripcion', 'idioma', 'precio', 'cupos', 'organizado','destacado');
			$r = $this->bdd->ejecutar($sql,$parametros,$tdp,$campos[0],$campos[1],$campos[2],$campos[3],$campos[4], $campos[5], $campos[6], $campos[7], $campos[8], $campos[9], $campos[10], $campos[11], $campos[12], $campos[13], $campos[14]);
			if(count($r)!=0){
				return $r;
			}
			else{
				return false;
			}
		}
	}
    public function getListaNoticias(){
        global $namedb;
        if($this->bdd->conectar()){
            $sql = "SELECT idnoticia, titulo, descripcion, idusuario, fechapublicacion, urlimagenhome, urlthumbnail, urlafiche, destacado FROM ".$namedb.".vista_noticias";

            $tdp = null;
            $parametros = null;
            $campos = array('idnoticia', 'titulo', 'descripcion', 'idusuario', 'fechapublicacion', 'urlimagenhome', 'urlthumbnail', 'urlafiche', 'destacado');
            $r = $this->bdd->ejecutar($sql,$parametros,$tdp,$campos[0],$campos[1],$campos[2],$campos[3],$campos[4], $campos[5], $campos[6], $campos[7], $campos[8]);
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
