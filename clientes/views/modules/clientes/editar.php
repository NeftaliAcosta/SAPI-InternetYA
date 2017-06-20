<?php 
/*	if(isset( $_GET['id'])){

				$respuesta = Datos::validarID($_GET['id']);

				if($respuesta >0){

                     $detalleusuario = new MvcController();
                     $detalleusuario -> verUsuarioCompletoController($respuesta);

				}else{
					echo '<div class="alert alert-danger">
                                El usuario al que intentas acceder no existe en el sistema.
                            </div>
                            <a href="panel.php?modulo=clientes&action=crear"<button type="button" class="btn btn-primary">Creear Cliente</button></a>'



                            ;
				}

			}

			*/

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
		else{
		echo  '
			<div class="alert alert-danger">
            	Error de parámetros.
            </div>
			';
		}
	}else{
		echo  '
			<div class="alert alert-danger">
            	Error de parámetros.
            </div>
			';
	}
 ?>


