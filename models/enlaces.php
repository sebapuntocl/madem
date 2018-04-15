<?php 

class EnlacesModels{

	public function enlacesModel($enlaces){

		if($enlaces == "ingresar" ||
		   $enlaces == "dashboard" || 
		   $enlaces == "clientes" || 
		   $enlaces == "clienteEditar" || 
		   $enlaces == "registro" || 
		   $enlaces == "perfil" || 
		   $enlaces == "eventos" ||
		  // $enlaces == "camClave" ||
		   $enlaces == "salir" ||
		   $enlaces== "borrar"){

			$module = "views/modules/".$enlaces.".php";
		}	

		else if($enlaces == "index"){
			$module = "views/modules/ingresar.php";
		}

		else{
			$module = "views/modules/ingresar.php";		
		}

		return $module;

	}


}