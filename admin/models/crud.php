<?php 
	require_once "conexion.php";

	class Datos extends Conexion{



		#Login de usuario
		#---------------------------

		public function ingresoAdminModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, Privilegio, Estatus FROM $tabla WHERE usuario = :usuario");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$respuesta = $stmt->execute();
		$respuesta = $stmt->fetch();

			if($respuesta["usuario"] == $datosModel["usuario"] && $respuesta["password"] == $datosModel["password"] && $respuesta["Privilegio"]==0 && $respuesta["Estatus"]==1) {
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
			$stmt = Conexion::conectar()->prepare("select id, NomLocalidad, Observacion from localidades order by NomLocalidad");
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
			$stmt = Conexion::conectar()->prepare("select FechaCorte from usuarios where id=:id");
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
		
		#Crear nueva Localidad
		public function crearLocalidadModel($localidad,$referencia){
			$test = Datos::validarLocalidadModel($localidad);
				if($test==1){
					$stmt = Conexion::conectar()->prepare("INSERT INTO localidades(NomLocalidad, Observacion) VALUES(:localidad,:referencia)");
					$stmt->bindParam(":localidad", $localidad, PDO::PARAM_STR);
					$stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
					
					if($stmt->execute()){
						return 1;
					}else{
						return 0;
					}
				}else{
					return 0;
				}


		}
		
		public function actualizarLocalidadModel($id,$localidad,$referencia){ 
			$stmt = Conexion::conectar()->prepare('UPDATE localidades set NomLocalidad ="'.$localidad.'", Observacion="'.$referencia.'"  where id='.$id.'');
					
			if($stmt->execute()){
				return 1;
				}else{
					return 0;
				}
					
		}
		
		public function validarLocalidadModel($localidad){ 
			$stmt = Conexion::conectar()->prepare("select  id from  localidades where NomLocalidad =  :localidad");
			$stmt->bindParam(":localidad", $localidad, PDO::PARAM_STR);			
			
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
				if(count($respuesta["id"]) == 0){
					return 1;
				}else{
					return 0;
				}
		}
		
		public function selectlocalidad($id){ 
		
			$stmt = Conexion::conectar()->prepare("select * from  localidades where id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);		
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
			return $respuesta;
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
					$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, Nombre, Apellido1, Apellido2, Direccion, Referencia, Privilegio, Estatus, Telefono, Correo, Localidad, FechaCorte) VALUES ( :usuario,:password,:nombre,:apellido1, :apellido2, :direccion, :referencia,:privilegio, 1,:telefono,:correo, :localidad,:fechacorte)");

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
								
                            	";
							return 1;
						}
						else{
							return "Error en los parámetros.";
						}

					}
					else{
						
						echo '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                El usuario ya existe en el sistema.
                            </div>';
					}

			




		}


		public function actualizarUsuarioModel($datosModel){ 
			

			$stmt = Conexion::conectar()->prepare('UPDATE usuarios SET password="'.$datosModel["password"].'", Nombre="'.$datosModel["nombre"].'", Apellido1="'.$datosModel["apellido1"].'", Apellido2="'.$datosModel["apellido2"].'", Correo="'.$datosModel["email"].'" , Direccion="'.$datosModel["direccion"].'", Referencia="'.$datosModel["referencia"].'", Localidad='.$datosModel["localidad"].', Estatus="'.$datosModel["estado"].'", Telefono="'.$datosModel["telefono"].'", FechaCorte='.$datosModel["corte"].' where ID='.$datosModel["id"].' ');



			if($stmt->execute()){
				return 1;			
			}else{
							
			return 0;
			}



		}



		#Ver Usuario Model
		#----------------------------------------------------

		public function verUsuarioModel($idusuario){
			$idusuario = Datos::desencriptar($idusuario);
			$stmt = Conexion::conectar()->prepare("select usuarios.id, usuarios.usuario, usuarios.Nombre, usuarios.Apellido1, usuarios.Apellido2, usuarios.Direccion, usuarios.Referencia, usuarios.Telefono, localidades.Nomlocalidad,  cortes.FechaCorte from usuarios inner join localidades on usuarios.localidad=localidades.id  inner join cortes on usuarios.FechaCorte=cortes.id where usuarios.id !=:id order by id");

			$stmt->bindParam(":id", $idusuario, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}


		public function validarID($id){
			$idd = Datos::desencriptar($id);
			$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id=:id");
			$stmt->bindParam(":id", $idd, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
			if(count($respuesta["usuario"]) > 0){
				return $respuesta;
			}
			else{
				return 0;
			}
		}

		public function validarPagoCanceladoModel($id){
			$idd = Datos::desencriptar($id);
			$stmt = Conexion::conectar()->prepare("
				select * from historialpagos where id=:id
				");
			$stmt->bindParam(":id", $idd, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetch();
				if(count($respuesta["id"]) > 0){
					return 1;
				}
				else{
					return 0;
				}

		}


		public function validarPagoModel($id){
			$id=mysql_real_escape_string($id);
			$idd = Datos::desencriptar($id);
			$stmt = Conexion::conectar()->prepare("
				select historialpagos.id,  usuarios.usuario, usuarios.Nombre, usuarios.Apellido1, usuarios.FechaCorte, historialpagos.id_usuario, historialpagos.fecha,  cortes.FechaCorte, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Importe, historialpagos.Concepto, historialpagos.observaciones from historialpagos 

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
				select historialpagos.id, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Concepto, historialpagos.observaciones from $tabla 
				inner join usuarios on historialpagos.id_usuario=usuarios.id  and usuarios.id=:id
				inner join estadopago on historialpagos.EstadoPago=estadopago.id
				
				");
			$stmt->bindParam(":id", $idusuariomodel, PDO::PARAM_INT);
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		



		public function pagosPendientesModel(){
			$stmt = Conexion::conectar()->prepare(" 
					select historialpagos.id, usuarios.id as idcliente, usuarios.usuario, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Concepto, historialpagos.Importe, historialpagos.observaciones from historialpagos 

					inner join usuarios on historialpagos.id_usuario=usuarios.id 
					inner join estadopago on historialpagos.EstadoPago=estadopago.id and estadopago.id=3
				");
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		public function pagosRecientesModel(){
			$stmt = Conexion::conectar()->prepare("
			select historialpagos.id, usuarios.usuario, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.concepto, historialpagos.Importe, historialpagos.observaciones from historialpagos 
	inner join usuarios on historialpagos.id_usuario=usuarios.id 
	inner join estadopago on historialpagos.EstadoPago=estadopago.id 
	order by historialpagos.id DESC LIMIT 7
				");
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		public function pagosRealizadosModel(){
			$stmt = Conexion::conectar()->prepare("
					select historialpagos.id, usuarios.id as idcliente, usuarios.usuario, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Concepto, historialpagos.Importe, historialpagos.observaciones from historialpagos 

					inner join usuarios on historialpagos.id_usuario=usuarios.id 
					inner join estadopago on historialpagos.EstadoPago=estadopago.id and estadopago.id=4
				");
			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			
			return $respuesta;
		}
		
				
		public function pagosCanceladosModel(){
			$stmt = Conexion::conectar()->prepare("
					select historialpagos.id, usuarios.id as idcliente, usuarios.usuario, usuarios.Nombre, historialpagos.fecha, historialpagos.comprobante, historialpagos.Referencia, estadopago.Estado, historialpagos.Concepto, historialpagos.Importe, historialpagos.observaciones from historialpagos 

					inner join usuarios on historialpagos.id_usuario=usuarios.id 
					inner join estadopago on historialpagos.EstadoPago=estadopago.id and estadopago.id=5
				");
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



		public function obtenerTicketsModel(){
			$stmt = Conexion::conectar()->prepare("select tickets.id, usuarios.ID as idusuario, usuarios.usuario, usuarios.nombre, usuarios.apellido1,  tickets.prioridad, tickets.asunto, tickets.fecha, tickets.estado from tickets
				inner join usuarios on usuarios.id=tickets.idusuario order by tickets.estado desc, tickets.prioridad desc");

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

		public function usuariosTicketsModel(){
			$stmt= Conexion::conectar()->prepare("select id, usuario from usuarios where privilegio=1 and estatus=1");
			$stmt->bindParam(":idticket", $idTicket, PDO::PARAM_INT);
			$stmt->bindParam(":idusuario", $idUsuario, PDO::PARAM_INT);	
			$stmt->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
			$stmt->bindParam(":clase", $clase, PDO::PARAM_INT);


			$respuesta = $stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		public function crearTicketModel($idUsuario, $asunto, $prioridad, $mensaje, $clase){
			$stmt = Conexion::conectar()->prepare("INSERT INTO tickets (idusuario, asunto, prioridad, fecha, estado) VALUES (:idusuario, :asunto, :prioridad,  now(), 1 )");

			$stmt->bindParam(":idusuario", $idUsuario, PDO::PARAM_INT);
			$stmt->bindParam(":asunto", $asunto, PDO::PARAM_STR);
			$stmt->bindParam(":prioridad", $prioridad, PDO::PARAM_INT);
			$stmt->execute();

			$stmt= Conexion::conectar()->prepare("SELECT MAX(id) as idTicket FROM tickets");
			$stmt->execute();
			$idticket = $stmt->fetch(PDO::FETCH_ASSOC);
			$myidticket = $idticket["idTicket"];
			return $myidticket;
			
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

		public function eliminarPagoModel($idpago){
			$contador=0;
			$stmt=Conexion::conectar()->prepare("SELECT id, comprobante FROM historialpagos WHERE id=:id");
			$stmt->bindParam(":id", $idpago, PDO::PARAM_INT);
			if($stmt->execute()){
				$respuesta = $stmt->fetch();
				$foto = $respuesta["comprobante"];
				$ruta = "..\imagenes/$foto";
				unlink($ruta);
				$contador = $contador + 1;
			}

			$stmt= Conexion::conectar()->prepare("delete from historialpagos where id=:id");
			$stmt->bindParam(":id", $idpago, PDO::PARAM_INT);
			if($stmt->execute()){
				$contador = $contador + 1;

			}

			return $contador;
			
		}
		

		public function eliminarUsuarioModel($idUsuario){
			//Eliminar Las fotos de los pagos
			$stmt=Conexion::conectar()->prepare("SELECT id, comprobante FROM historialpagos WHERE id_usuario=:id");
			$stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);
			if($stmt->execute()){
				$respuesta = $stmt->fetchAll();
				$final = count($respuesta);
				for($i=0; $i<$final; $i++){
					$foto = $respuesta[$i]["comprobante"];
					$ruta = "..\imagenes/$foto";
					unlink($ruta); 
				}

			$contador = 4;
			$stmt= Conexion::conectar()->prepare("delete from detalletickets where idusuario=:id");
			$stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);
			if($stmt->execute()){
				$contador = 1;
			}

			$stmt= Conexion::conectar()->prepare("delete from tickets where idusuario=:id");
			$stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);
			if($stmt->execute()){
				$contador = $contador + 1;

			}
			$stmt= Conexion::conectar()->prepare("delete from historialpagos where id_usuario=:id");
			$stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);
			if($stmt->execute()){
				$contador = $contador + 1;

			}

			$stmt= Conexion::conectar()->prepare("delete from usuarios where id=:id");
			$stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);
			if($stmt->execute()){
				$contador = $contador + 1;

			}
			
			
			
			return $contador;
 
			}


			
			
		}


		public function sistemaModel(){
			$stmt=Conexion::conectar()->prepare("select * from sistema where id=1");
			if($stmt->execute()){
				$respuesta = $stmt->fetch();
				return $respuesta;
			}else{
				$this->mensajeError();
			}
			
			
		}

		public function actualizarSistemaModel($datosModel){
		
			$stmt = Conexion::conectar()->prepare('UPDATE sistema SET nTickets="'.$datosModel["ntickets"].'", nPagos="'.$datosModel["npagos"].'", nClientes="'.$datosModel["nclientes"].'", nAviso="'.$datosModel["naviso"].'", eSistema="'.$datosModel["esistema"].'", nSistema="'.$datosModel["nsistema"].'", txtAviso="'.$datosModel["txtaviso"].'", txtBancarios="'.$datosModel["txtbancarios"].'" where id=1 ');

			if($stmt->execute()){
				return 1;			
			}else{
				return 0;
			}
		}
		public function detalleSistema(){
			$stmt= Conexion::conectar()->prepare("select * from sistema where id=1");
			$stmt->execute();
			$respuesta = $stmt->fetch();
			return $respuesta;
		}

		public function getLastIdModel(){
			$stmt = Conexion::conectar()->prepare("set @id=(SELECT MAX(id) AS id FROM usuarios)");
			$stmt->execute();
			$respuesta = $stmt->fetchAll();
			return $respuesta;
		}

		public function getlastUserModel(){
			$id = $this->getLastIdModel();
			$stmt = Conexion::conectar()->prepare("select usuario from usuarios where id = :id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			$respuesta = $stmt->fetchAll();
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
 