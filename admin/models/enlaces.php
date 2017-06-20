<?php 

class Paginas{
	
	public function enlacesPaginasModel($moduloModel, $actionModel){

		if($moduloModel=='localidades' || $moduloModel=='config' ||$moduloModel=='perfil' || $moduloModel=='clientes' || $moduloModel=='facturas' || $moduloModel=='cancelaciones' || $moduloModel=='tickets' || $moduloModel=='pagos'){
			$modulo = $moduloModel;
		}else{
			$modulo = "home";
		}
		
		if($actionModel=='crear' || $actionModel=="editar" || $actionModel=="ver" || $actionModel=="home"){
			$action = $actionModel;
		}else{
			$action =  "home";
		}

		if($moduloModel=='home'){
			$action =  "home";
		}


		$ruta = "views/modules/". $modulo . "/".$action.".php";	
		
		return $ruta;
 
	}

}

?>