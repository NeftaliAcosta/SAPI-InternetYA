<?php
	if(isset( $_GET['edit'])){
		echo '<script type="text/javascript">window.setTimeout(function(){   
						window.location="panel.php?modulo=localidades&edit=1"
						},); 
			        </script>';
	}
?>