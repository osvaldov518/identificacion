<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){

		// t ==> tabla
		// g ==> grafica
		// p ==> proceso de inserción
		// e ==> eliminar datos insertados
		// a ==> analisis de correlación
		// gs ==> Grafica Suavizada
		// h ==> Home/Inicio

		if($enlaces == "t" || $enlaces == "g" || $enlaces == "p" || $enlaces == "e" || $enlaces == "a" || $enlaces == "gs"){

			$module =  "views/modules/".$enlaces.".php";
		
		}

		else{

			$module =  "views/modules/h.php";

		}
		
		return $module;

	}

}

?>