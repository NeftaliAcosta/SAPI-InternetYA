<?php 
	if(isset( $_GET['id'])){
		$a =Datos::validarPagoModel($_GET['id']);

		$hash =urlencode($_GET['id']);
		$idu = urlencode(Datos::encriptar($a["id_usuario"]));
		if($a >0){
			echo '
			<div class="formatopago">
	<div class="row ">
			<div class="col-sm-6">
				<h4>Detalles de pago</h4>
				<hr>
				<h4>Resumen del pago</h4>
		        <p>Enviado por: <b> <a href="panel.php?modulo=clientes&action=ver&id='.$idu.'">'.$a["Nombre"] .' '. $a["Apellido1"].'</a></b></p>
		        <p>Fecha de envío: <b>'.$a["fecha"] .'</b></p>
		         <p>Corte del servicio: <b>'.$a["FechaCorte"] .'</b></p>
		        <p>ID Cliente: <b>'.$a["usuario"] .'</b></p>
		        <p>Concepto: <b>Servicio '.$a["Concepto"] .'</b></p>
		        <p>Importe: <b>$ '.$a["Importe"] .'</b></p>
		        <p>Referencia: <b>'.$a["Referencia"] .'</b></p>
		        <p class="text-danger">Estatus: <b>'.$a["Estado"] .'</b></p>
		        <p>Id único: <b>'.$a['id'].'</b></p><br><br>
		        <div class="alert alert-info alert-dismissable">
					<h4>Nota enviada por el cliente:</b></h4>
					<p>'.$a["observaciones"].'.</p>
				</div>
			</div>

			<div class="col-sm-6">
				<img src="../imagenes/'.$a['comprobante'].'" class="img-responsive imgpago">
			</div>
	</div>

		<a href="panel.php?modulo=pagos&action=editar&id='.$hash.'&var=1"><button type="button" name="variable1" class="btn btn-primary mybtn">Convertir a Factura</button></a>
	
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
