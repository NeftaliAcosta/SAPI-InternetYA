<?php 
	if(isset( $_GET['id'])){
		$id=$_GET['id'];

		if(isset($_GET['var'])){

			if($_GET['var']==1){
				$var=4;
			}
			elseif($_GET['var']==0){
				$var=5;
			}else{
				$var=3;
			}
			$a = new MvcController();
			$a -> actualizarPagoController($id, $var);

		}
	else{
		echo "Sin variable";
	}
	}
	else{
		echo "Sin ID";
	}


