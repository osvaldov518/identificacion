<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){


		if($enlaces == "t" || $enlaces == "g" || $enlaces == "p"){

			$module =  "views/modules/".$enlaces.".php";
		
		}

		else{

			$module =  "views/modules/h.php";

		}
		
		return $module;

	}

}

?>