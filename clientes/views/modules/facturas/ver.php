<?php 
	if(isset( $_GET['id'])){
		$a =Datos::validarPagoModel($_GET['id']);

			$hash =urlencode($_GET['id']);
		#var_dump($a);
		if($a >0){
			echo '
			<div class="formatopago">
	<div class="row ">
			<div class="col-sm-6">
				<h4>Detalles de Factura</h4>
				<hr>
				<h4>Detalles del pago</h4>
		        <p>Enviado por: <b>'.$a["Nombre"] .' '. $a["Apellido1"].'</b></p>
		        <p>Fecha de envío: <b>'.$a["fecha"] .'</b></p>
		         <p>Corte del servicio: <b>'.$a["FechaCorte"] .'</b></p>
		        <p>Usuraio: <b>'.$a["usuario"] .'</b></p>
		        <p>Concepto: <b>Servicio '.$a["Concepto"] .'</b></p>
		        <p>Importe: <b>$ '.$a["Importe"] .'</b></p>
		        <p>Referencia: <b>'.$a["Referencia"] .'</b></p>
		        <p class="text-success">Estatus: <b>'.$a["Estado"] .'</b></p>
		        <p>Id único: <b>'.$_GET['id']. + $a['id'].'</b></p><br><br>
		        <div class="alert alert-info alert-dismissable">
					<h4>Nota enviada por el cliente:</b></h4>
					<p>'.$a["observaciones"].'</p>
				</div>
			</div>

			<div class="col-sm-6">
				<img src="../imagenes/'.$a['comprobante'].'" class="img-responsive imgpago">
			</div>
	</div>



</div>
';
		}
		else{
		echo 
			'<div class="alert alert-danger">
                El pago al que intentas acceder no existe en el sistema.
            </div>';
		}


	}
 ?>