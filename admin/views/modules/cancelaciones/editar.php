<?php 

if(mysql_real_escape_string(isset($_GET["id"]))){ 
	$var = Datos::validarPagoCanceladoModel($_GET["id"]);
	if ($var==1 and $_GET["var"]==2){

		$respuesta = new MvcController();
		$respuesta -> eliminarPagoController($_GET["id"]);
	}else{
		echo  '
		<div class="alert alert-danger">
           	Error de parámetros.
   	    </div>
   	    
		';
		
	}
}



