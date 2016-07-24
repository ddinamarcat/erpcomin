<?
/* Trata las fechas en los formatos 'dd-mm-aaaa' y MySQL 'Y-m-d H:i:s'  */
//setlocale(LC_ALL,"es_ES"); //Aqui se setea el idioma espanhol para fechas, etc.
date_default_timezone_set('America/Santiago'); //Setea timezone

class Fecha {
	private $fh;
	/* Coloca en $fh la fecha actual por defecto */
	function __construct() {
		$this->fh = strtotime(date('d-m-Y H:i:s'));
	}
	/* retorna una fecha en string, generado a partir de fh, en el formato dd-mm-aaaa */
	public function obtenerSoloFecha(){
		return date('d-m-Y',$this->fh);
	}

	/* retorna la hora en string, generado a partir de fh, en el formato dd-mm-aaaa */
	public function obtenerSoloHora(){
		return date('H:i:s',$this->fh);
	}


	/* Coloca en $fh la fecha y hora actual por defecto */
	public function ponerFechaHoraActual() {
		$this->fh = strtotime(date('d-m-Y H:i:s'));
	}

	/* Coloca en $fh la fecha y hora $f ingresada */
	public function ponerFechaHora($f) {
		$this->fh = strtotime($f);
	}

	/* Retorna el formato de una fecha para ser procesada por MySQL *
	 * Ingresar fecha y hora en formato de texto 'd-m-Y H:i:s'      */
	public function obtenerFormatoParaMySql(){
		return date('Y-m-d H:i:s',$this->fh);
	}

	/* retorna un string de 3 caracteres con el nombre
	 * abreviado, en ingles, del dia de la semana correspondiente a fh */
	public function obtenerDiaDeLaSemana(){
		return strftime("%a",$this->fh);
	}


	public function agregaDias($a){
		return mktime(date('H',$this->fh),date('i',$this->fh),date('s',$this->fh),date('m',$this->fh),date('d',$this->fh)+$a,date('Y',$this->fh));
	}

	/* $dh = dias habiles, $da = dias adicionales */
	public function calculaFechaPropuesta($dh,$da){
		$td = $dh+$da; //Total de dias a agregar

		$dbqnstels = 2; //dias base que no se trabajan en la semana

		$t1 = $this->fh; //Fecha Hora temporal

		$H = date('H',$t1); //
		$i = date('i',$t1); // Se hace una copia de la Hora
		$s = date('s',$t1); //

		//Aqui se hace un analisis por semana habil, si el trabajo requiere de mas de 7 dias habiles
		//se puede asegurar que no se trabajan 2 dias (sabados y domingos), pero hay que ver cuantos
		//feriados hay en ese periodo. Asi, $td = 2 + numero de feriados en esa semana (sin contar
		//los sabados feriados como adicionales). FALTA LA PARTE DE LOS FERIADOS!!
		while ( $td > 0){
			// si es mas de una semana
			if ( $td >= 7 ){ 
				$td += $dbqnstels; //no se trabajan sabados y domingos
				//implementar incrementar $td con el numero
				//de feriados en el periodo de la semana
				$td -= 7;
				$t1 = mktime($H,$i,$s,date('m',$t1),date('d',$t1)+7,date('Y',$t1));
			}
			else{
				$c = 1; //contador
				$incremento = 1;
				while ( $c <= $td ){

					$t1 = mktime($H,$i,$s,date('m',$t1),date('d',$t1)+$incremento,date('Y',$t1));
					$cond = strftime("%a",$t1);
					
					if ( $cond == 'Sat' ){
						$td += 2;
						$incremento = 2;
					}
					else if ( $cond == 'Sun' ){
						$td +=1;
						$incremento = 1;
					}
					/* else if(si corresponde a un feriado
					 * entonces hay que incrementar $td y $c en 1) */
					
					//si corresponde a un dia de trabajo
					else{
						$incremento = 1;
					}
					$c += $incremento;
					
				}
				$td = 0;
			}
		}
		return date('d-m-Y',$t1);
	}
}

?>
