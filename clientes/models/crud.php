<?php 
	require_once "conexion.php";

	class Datos extends Conexion{



		#Login de usuario
		#---------------------------

		public function ingresoUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, Privilegio, Estatus FROM $tabla WHERE usuario = :usuario");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$respuesta = $stmt->execute();
		$respuesta = $stmt->fetch();

			if($respuesta["usuario"] == $datosModel["usuario"] && $respuesta["password"] == $datosModel["password"] && $respuesta["Privilegio"]==1 && $respuesta["Estatus"]==1) {
				return $respuesta;
			}
			else{
				return "no";
				}

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
	

		$stmt->close();
		}



		#Obtener localidades
		public function obtenerLocalidadesModel(){
			$stmt = Conexion::conectar()->prepare("select id, NomLocalidad from localidades order by NomLocalidad");
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();

			return $respuesta;
			$stmt->close();
			
		}

		#Obtener localidades
		public function obtenerCortesModel(){
			$stmt = Conexion::conectar()->prepare("select *  from cortes");
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();

			return $respuesta;
			$stmt->close();
			
		}

		#Obtener localidades
		public function obtenerCorteUsuarioModel($idModel){
			$stmt = Conexion::conectar()->prepare("select cortes.FechaCorte from usuarios
			inner join cortes on usuarios.FechaCorte=cortes.id where usuarios.id=:id");
			$stmt->bindParam(":id", $idModel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();

			return $respuesta;
			$stmt->close();
			
		}


		#Obtener localidad del usuario
		public function obtenerLocalidadUsuarioModel($idModel){

			$stmt = Conexion::conectar()->prepare("select localidad from usuarios where id=:id");
			$stmt->bindParam(":id", $idModel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();

			return $respuesta;
			$stmt->close();
			
		}

		public function obtenerEstadoModel($idModel){
			$stmt = Conexion::conectar()->prepare("select Estatus from usuarios where id=:id");
			$stmt->bindParam(":id", $idModel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
			return $respuesta;
			
		}
		


		#Obtener Fechas de corte
		public function obtenerFechasModel(){
			$stmt = Conexion::conectar()->prepare("select id, FechaCorte from cortes");
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();

			return $respuesta;
			$stmt->close();
		}

		#Crear Usuario
		#---------------------------
		public function crearUsuarioModel($datosModel, $tabla){

			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
			#Primero se valida si el usuario NO existe en el sistema
			$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();


				if(count($respuesta["usuario"]) == 0){
					$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, Nombre, 											Apellido1, Apellido2, Direccion, Referencia, 											Privilegio, Estatus, Telefono, Correo, Localidad, 										FechaCorte) VALUES ( :usuario,:password,:nombre,:apellido1, :apellido2, :direccion, :referencia,:privilegio, 1,:telefono,:correo, :localidad,:fechacorte)");

						$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
						$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
						$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
						$stmt->bindParam(":apellido1", $datosModel["apellido1"], PDO::PARAM_STR);
						$stmt->bindParam(":apellido2", $datosModel["apellido2"], PDO::PARAM_STR);
						$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
						$stmt->bindParam(":referencia", $datosModel["referencia"], PDO::PARAM_STR);
						$stmt->bindParam(":privilegio", $datosModel["privilegio"], PDO::PARAM_INT);
						#$stmt->bindParam(":estatus", $datosModel["privilegio"], PDO::PARAM_INT);
						$stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
						$stmt->bindParam(":correo", $datosModel["email"], PDO::PARAM_STR);
						$stmt->bindParam(":localidad", $datosModel["localidad"], PDO::PARAM_INT);
						$stmt->bindParam(":fechacorte", $datosModel["fechacorte"], PDO::PARAM_INT);
	


						if($stmt->execute()){

							echo "<div class='alert alert-success'>
                               		Se creó el usuario correctamente.
                            	</div>
								<script type='text/javascript'>window.setTimeout(function(){   
				          	  window.location='panel.php?modulo=clientes&action=home'
					        	}, 2000);
					        	</script>
                            	";
						}
						else{
							return "Error";
						}

					}
					else{
						echo "El usuario ya existe en el sistema.";
					}

			




		}


		public function actualizarUsuarioModel($datosModel){

			$stmt = Conexion::conectar()->prepare('UPDATE usuarios SET password="'.$datosModel["password"].'", Telefono="'.$datosModel["telefono"].'" where ID='.$datosModel["id"].' ');


			if($stmt->execute()){
				return 1;			
			}else{
							
			return 0;
			}



		}



		#Ver Usuario Model
		#----------------------------------------------------

		public function verUsuarioModel(){
			$stmt = Conexion::conectar()->prepare("select usuarios.id, usuarios.usuario, usuarios.Nombre, usuarios.Apellido1, usuarios.Apellido2, usuarios.Direccion, usuarios.Referencia, usuarios.Telefono, localidades.Nomlocalidad,  cortes.FechaCorte from usuarios inner join localidades on usuarios.localidad=localidades.id  inner join cortes on usuarios.FechaCorte=cortes.id order by id");

			$stmt->execute();

			return $stmt->fetchAll();

			$stmt->close();
		}


		public function validarID($id){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);

			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();


				if(count($respuesta["usuario"]) > 0){
					return $respuesta;
				}
				else{
					return 0;
				}

		}


		public function validarPagoModel($id){
			$idd = Datos::desencriptar($id);
			$stmt = Conexion::conectar()->prepare("
				select historialpagos.id,  usuarios.usuario, usuarios.Nombre, usuarios.Apellido1, usuarios.FechaCorte, historialpagos.fecha,  cortes.FechaCorte, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Importe, historialpagos.Concepto, historialpagos.observaciones from historialpagos 

				inner join usuarios on historialpagos.id_usuario=usuarios.id  and historialpagos.id=:id
				inner join estadopago on historialpagos.EstadoPago=estadopago.id 
				inner join cortes on usuarios.fechacorte = cortes.id

				");
			$stmt->bindParam(":id", $idd, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
				if(count($respuesta["id"]) > 0){
					return $respuesta;
				}
				else{
					return 0;
				}

		}


		public function validarPago($id){

			$stmt = Conexion::conectar()->prepare("select * from historialpagos where id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();

				if(count($respuesta["id"]) > 0){
					return $respuesta;
				}
				else{
					return 0;
				}

		}

		public function actualizarPagoModel($idController, $estadoController){
			$stmt= Datos::conectar()->prepare("update historialpagos set estadopago=:estado where id=:id");
			$stmt->bindParam(":estado",  $estadoController, PDO::PARAM_INT);
			$stmt->bindParam(":id",  $idController, PDO::PARAM_INT);

			$respuesta = $stmt->execute();
			return $respuesta;
		}





		public function verUsuarioCompletoModel($idusuariomodel, $tabla){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");

			$stmt->bindParam(":id", $idusuariomodel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();

			return $respuesta;

		}


		public function verPagosModel($idusuariomodel, $tabla){
			$stmt = Conexion::conectar()->prepare("
				select historialpagos.id, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, conceptos.NomConcepto, historialpagos.observaciones from $tabla 
				inner join usuarios on historialpagos.id_usuario=usuarios.id  and usuarios.id=:id
				inner join estadopago on historialpagos.EstadoPago=estadopago.id
				inner join conceptos on historialpagos.Concepto=conceptos.id
				");
			$stmt->bindParam(":id", $idusuariomodel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		



		public function pagosPendientesModel($idusuario){
			$stmt = Conexion::conectar()->prepare("
					select historialpagos.id, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Concepto, historialpagos.Importe, historialpagos.observaciones from historialpagos 

					inner join usuarios on historialpagos.id_usuario=usuarios.id 
					inner join estadopago on historialpagos.EstadoPago=estadopago.id and estadopago.id=3 where historialpagos.id_usuario=:id
				");
			$stmt->bindParam(":id", $idusuario, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		public function pagosRecientesModel(){
			$stmt = Conexion::conectar()->prepare("
			select historialpagos.id, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, conceptos.NomConcepto, historialpagos.Importe, historialpagos.observaciones from historialpagos 
	inner join usuarios on historialpagos.id_usuario=usuarios.id 
	inner join estadopago on historialpagos.EstadoPago=estadopago.id 
	inner join conceptos on historialpagos.Concepto=conceptos.id 
	order by historialpagos.id DESC LIMIT 5
				");
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		public function pagosRealizadosModel($idusuario){
			$stmt = Conexion::conectar()->prepare("
					select historialpagos.id, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Concepto, historialpagos.Importe, historialpagos.observaciones from historialpagos 

					inner join usuarios on historialpagos.id_usuario=usuarios.id 
					inner join estadopago on historialpagos.EstadoPago=estadopago.id and estadopago.id=4 where historialpagos.id_usuario=:id
				");
			$stmt->bindParam(":id", $idusuario, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			
			return $respuesta;
		}
		
				
		public function pagosCanceladosModel($idusuario){
			
			$stmt = Conexion::conectar()->prepare("
					select historialpagos.id, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Concepto, historialpagos.Importe, historialpagos.observaciones from historialpagos 
					inner join usuarios on historialpagos.id_usuario=usuarios.id 
					inner join estadopago on historialpagos.EstadoPago=estadopago.id and estadopago.id=5 where historialpagos.id_usuario=:id
				");
			$stmt->bindParam(":id", $idusuario, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
	
			return $respuesta;
		}

		public function estadisticaModel(){

		}

		public function obtenerClientesModel(){
			$stmt = Conexion::conectar()->prepare("select count(*) from usuarios");
			$respuesta = $stmt -> execute();
			$respuesta = $stmt -> fetch();

			return $respuesta;
		}
		public function obtenerFacturasModel(){
			$stmt = Conexion::conectar()->prepare("select count(*) from historialpagos where EstadoPago=4");
			$respuesta = $stmt -> execute();
			$respuesta = $stmt -> fetch();

			return $respuesta;
		}
		public function obtenerPendientesModel(){
			$stmt = Conexion::conectar()->prepare("select count(*) from historialpagos where EstadoPago=3");
			$respuesta = $stmt -> execute();
			$respuesta = $stmt -> fetch();

			return $respuesta;
		}

		public function obtenerTicketsAbiertosModel(){
			$stmt = Conexion::conectar()->prepare("select count(*) from tickets where estado=1");
			$respuesta = $stmt -> execute();
			$respuesta = $stmt -> fetch();

			return $respuesta;
		}



		public function obtenerTicketsModel($idusuarioModel){
			$stmt = Conexion::conectar()->prepare("select tickets.id, usuarios.nombre, usuarios.apellido1,  tickets.prioridad, tickets.asunto, tickets.fecha, tickets.estado from tickets
				inner join usuarios on usuarios.id=tickets.idusuario where tickets.idusuario=:id order by tickets.estado desc, tickets.prioridad desc ");
			$stmt->bindParam(":id", $idusuarioModel, PDO::PARAM_INT);
			$respuesta = $stmt-> execute();
			$respuesta = $stmt -> fetchAll();
			
			return $respuesta;

		}

		public function obtenerTicketModel($idModel){
			$stmt = Conexion::conectar()->prepare("select tickets.id, usuarios.nombre, usuarios.apellido1,  tickets.prioridad, tickets.asunto, tickets.fecha, tickets.estado from tickets
			inner join usuarios on usuarios.id=tickets.idusuario where tickets.id=:id");

			$stmt->bindParam(":id", $idModel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
			
			if(count($respuesta["id"]) > 0){
					return $respuesta;
				}
				else{
					return 0;
				}

		}

		public function resummenTicketModel($idModel){
			$stmt = Conexion::conectar()->prepare("select detalletickets.idticket, usuarios.Nombre, usuarios.Apellido1,  detalletickets.texto, detalletickets.fecha, detalletickets.clase from detalletickets
				inner join usuarios on detalletickets.idusuario=usuarios.id where detalletickets.idticket=:id order by detalletickets.id");

			$stmt->bindParam(":id", $idModel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();

			return $respuesta;
		}

		public function validarTicketModel($idModel){

			$stmt = Conexion::conectar()->prepare("select * from tickets where id=:id");
			$stmt->bindParam(":id", $idModel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
			if(count($respuesta["id"]) > 0){
					return 1;
				}
				else{
					return 0;
				}
		}

		public function cerrarTicketModel($idModel){
			$stmt = Conexion::conectar()->prepare("update tickets set estado=0 where id=$idModel");

			if($stmt->execute()){
				return 1;			
			}else{
							
			return 0;
			}
		}

		public function mensajeTicketModel($idTicket, $idUsuario, $mensaje, $clase){
			$id = $idTicket;
			$stmt = Conexion::conectar()->prepare("INSERT INTO detalletickets (idticket, idusuario, texto, fecha, clase) VALUES (:idticket, :idusuario, :mensaje,  now(), :clase )");

			$stmt->bindParam(":idticket", $idTicket, PDO::PARAM_INT);
			$stmt->bindParam(":idusuario", $idUsuario, PDO::PARAM_INT);	
			$stmt->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
			$stmt->bindParam(":clase", $clase, PDO::PARAM_INT);


						if($stmt->execute()){
							return 1;
						}
						else{
							return 0;
						}
		}

		public function usuarioTicketsModel($idModel){
			#var_dump($idModel);
			$stmt= Conexion::conectar()->prepare("select usuario from usuarios where id=:id");
			$stmt->bindParam(":id", $idModel, PDO::PARAM_INT);


			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
			echo $respuesta[0];
			#return $respuesta;
		}

		public function crearTicketModel($idUsuario, $asunto, $prioridad, $mensaje, $clase){
			$stmt = Conexion::conectar()->prepare("INSERT INTO tickets (idusuario, asunto, prioridad, fecha, estado) VALUES (:idusuario, :asunto, :prioridad,  now(), 1 )");

			$stmt->bindParam(":idusuario", $idUsuario, PDO::PARAM_INT);
			$stmt->bindParam(":asunto", $asunto, PDO::PARAM_STR);
			$stmt->bindParam(":prioridad", $prioridad, PDO::PARAM_INT);
			if($stmt->execute()){
				$stmt= Conexion::conectar()->prepare("SELECT MAX(id) as idTicket FROM tickets");
				if($stmt->execute()){
					$idticket = $stmt->fetch(PDO::FETCH_ASSOC);
					$myidticket = $idticket["idTicket"];
					return $myidticket;
				}else{
				$respuesta = $this->mensajeError();
				}
			}else{
				$respuesta = $this->mensajeError();
			}

			
		}

		public function conceptosModel(){
			$stmt = Conexion::conectar()->prepare("select * from conceptos");
			$stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		public function crearPagoModel($idusuario, $referencia, $estadopago, $concepto, $importe, $imagen, $mensaje){

			$stmt = Conexion::conectar()->prepare("INSERT INTO historialpagos (id_usuario, fecha, comprobante, referencia, EstadoPago, Concepto, Importe, observaciones ) VALUES (:idusuario, now(), :imagen, :referencia, :estadopago, :concepto, :importe, :mensaje)");
						
			
			$stmt->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
			$stmt->bindParam(":imagen", $imagen, PDO::PARAM_STR);
			$stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
			$stmt->bindParam(":estadopago", $estadopago, PDO::PARAM_INT);
			$stmt->bindParam(":concepto", $concepto, PDO::PARAM_STR);	
			$stmt->bindParam(":importe", $importe, PDO::PARAM_INT);
			$stmt->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
			if($stmt->execute()){
				return 1;
				}
				else{
					return 0;
				}

		}

		public function ultimafactura(){
			$stmt= Conexion::conectar()->prepare("SELECT MAX(id) as idfactura FROM historialpagos");
			$stmt->execute();
			$idfactura = $stmt->fetch(PDO::FETCH_ASSOC);
			$myidfactura = $idfactura["idfactura"];
			return $myidfactura;
		}


		public function detalleSistema(){
			$stmt= Conexion::conectar()->prepare("select * from sistema where id=1");
			$stmt->execute();
			$respuesta = $stmt->fetch();
			return $respuesta;
		}




		function encriptar($texto){
		    $key='gu';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
		    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $texto, MCRYPT_MODE_CBC, md5(md5($key))));
		    return $encrypted;
		}
		function desencriptar($texto){
		    $key='gu';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
		    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($texto), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		    return $decrypted;
		}



		public function mensajeError(){
			echo '
						<div class="alert alert-danger">
							<b>Algo salió mal en el sistema, por favor contacte al administrador.</b>
						</div>
						<script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php";

						    }, 1000);
						    </script>
					 		';
		}



}
 ?>