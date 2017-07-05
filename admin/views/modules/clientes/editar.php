<?php 
	if(isset($_GET["var"]) && isset($_GET["id"])){
		$var=$_GET["var"];
		$idusuario = urlencode($_GET["id"]);
		if($var==1){
			echo  '
			<div class="alert alert-success">
            	Actualización correcta.  
            </div>
            <script type="text/javascript">window.setTimeout(function(){   
          	  window.location="panel.php?modulo=clientes&action=ver&id='.$idusuario.'"
        	}, 1000);
        	</script>';
		}
		if($var==2){
			$idusuario= urldecode($idusuario);
			$eliminar = new MvcController();
			$eliminar -> eliminarUsuarioController($idusuario);
		}
		else{
		echo  '
			<div class="alert alert-danger">
            	Error de parámetros.
            </div>
			';
		}
	}
	elseif(isset($_GET["delete"])  && isset($_GET["id"])){
		$accion=$_GET["delete"];
		if($accion==1){
			$idusuario = $_GET["id"];
			$a = new MvcController;
			$a ->eliminarUsuarioController($idusuario);
		}
	}
	else{
		echo  '
			<div class="alert alert-danger">
            	Error de parámetros.
            </div>
			';
	}
 ?>


