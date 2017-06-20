<?php 

	if(isset( $_GET['id'])){
		$id=$_GET['id'];

		if(isset($_GET['var'])){

			if($_GET['var']==0){
			$a = new MvcController();
			$a -> cerrarTicketController($id);
			}
			else{
				echo 'Error de parámetros';
			}



		}elseif(isset($_GET['a'])){
			if($_GET['a']==1){
				$id=$_GET['id'];
				$hash = urldecode($id);
				echo'
				<div class="alert alert-success">
					Se envió el comentario correctamente.
                </div>
                <script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php?modulo=tickets&action=ver&id='.$hash.'";

						    },0);
				</script>
				';
			}else{
				echo 'Error de parámetros';
			}

		}
	else{
		echo 'Error de parámetros';
	}
	}
	else{
		echo 'Error de parámetros';
	}



 ?>