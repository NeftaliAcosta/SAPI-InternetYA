<?php 
	

	class MvcController{

		#Configuración de plantillas
		#---------------------------------

		public function pagina(){

			include "views/template.php";
		}

		#ENLACES
		#-------------------------------------

		public function enlacesPaginasController(){

			if(isset( $_GET['modulo'])){
				
				$modulo= $_GET['modulo'];
				 
			}else{

				$modulo = "home";

			}

			if(isset( $_GET['action'])){
				
				$action= $_GET['action'];
				 
			}else{

				$action = "home";

			}


			$respuesta = Paginas::enlacesPaginasModel($modulo, $action);

			include $respuesta;

		}

		public function ingresoUsuarioController(){
			if(isset($_COOKIE["id"])){
				$_SESSION["validar"] = true;
				$_SESSION["id"]=$_COOKIE["id"];
				header("location:panel.php");
			}
			
			if(isset($_POST["usuarioIngreso"]) and isset($_POST["passwordIngreso"]) and $_POST["usuarioIngreso"] != "" and $_POST["passwordIngreso"] != ""   ){

				$encriptar = Datos::encriptar($_POST["passwordIngreso"]);

				$datosController = array( "usuario" => $_POST["usuarioIngreso"], 
									      "password" => $encriptar);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

				if($respuesta=="no"){
				 echo "Datos incorrectos";
				}
				else{

					session_start();
					$_SESSION["validar"] = true;
					$_SESSION["id"] = $respuesta["id"];
					setcookie("id", $respuesta["id"], time()+600);
					header("location:panel.php");
				}


			}

		}

		#Llenar Formulario Localidades
		#-------------------------
		public function llenarFormLocalidadesController(){
			$localidades = Datos::obtenerLocalidadesModel();

			foreach ($localidades as $row) {
				echo "<option value='".$row[0]."' selected='selected'>" . $row[1]. "</option>";
			}

		}
		#Llenar Formulario Localidades Usuario
		#-------------------------
		public function llenarFormLocalidadeUsuarioController($idController){
			$localidades = Datos::obtenerLocalidadesModel();
			$localidad = Datos::obtenerLocalidadUsuarioModel($idController);
			
			foreach ($localidades as $row) {
				echo "<option value='".$row[0]; 
	
				if($row[0]==$localidad[0]){
					echo "' selected='selected'";
				} 

				echo "'>".$row[1]. "</option>";
			}

		}



		public function llenarFormCortesUsuarioController($idController){

			$corteUsuario = Datos::obtenerCorteUsuarioModel($idController);
			echo $corteUsuario["FechaCorte"];
			echo "<br><br>";


		}

		public function obtenerEstadoController($idcontroller){
			
			$respuesta = Datos::obtenerEstadoModel($idcontroller);
			if($respuesta[0]==1){
				echo'
				Activo
				';
			}else{
				echo'
				Inactivo
				';
			}
		}

		
		


		#Llenar Formulario FechasDeCorte
		#-------------------------
		public function llenarFormFechaCortesController(){
			$fechas = Datos::obtenerFechasModel();
			foreach ($fechas as $row) {
				echo "<div class='checkbox'><label><input type='checkbox' name='corteCrear' value='".$row[0] ." required
				'     >".$row[1]."</label></div>";
  
			}
		}



		#Crear Usuario
		#-------------------------
		public function crearUsuarioController(){
			if(isset($_POST["usuarioCrear"]) and 
				isset($_POST["passwordCrear"]) and 
				isset($_POST["privilegioCrear"]) and 
				isset($_POST["nombreCrear"]) and
				isset($_POST["apellido1Crear"]) and
				isset($_POST["apellido2Crear"]) and
				isset($_POST["emailCrear"]) and
				isset($_POST["direccionCrear"]) and
				isset($_POST["referenciaCrear"]) and
				isset($_POST["localidadCrear"]) and
				isset($_POST["telefonoCrear"]) and
				isset($_POST["corteCrear"])
				){

					$encriptar = crypt($_POST["passwordCrear"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$datosController = array( "usuario" => $_POST["usuarioCrear"], 
									      	  "password" => $encriptar, 
									      	  "privilegio" => $_POST["privilegioCrear"],
									      	  "nombre" => $_POST["nombreCrear"], 
									      	  "apellido1" => $_POST["apellido1Crear"],
									      	  "apellido2" => $_POST["apellido2Crear"],
									      	  "email" => $_POST["emailCrear"],
									      	  "direccion" => $_POST["direccionCrear"],
									      	  "referencia" => $_POST["referenciaCrear"],
									      	  "localidad" => $_POST["localidadCrear"],
									      	  "telefono" => $_POST["telefonoCrear"], 
									      	  "fechacorte" => $_POST["corteCrear"],       	
									      	  );


				$respuesta  = Datos::crearUsuarioModel($datosController, "usuarios");

				echo $respuesta;


			}
		}


		public function actualizarUsuarioController($datos){

			$update = Datos::actualizarUsuarioModel($datos);
			if($update==1){
				echo '
				<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Se actualizaron los datos correctamente.
                </div>
        	';
			}

		}


		#Ver Usuarios
		#---------------------------------

		public function verUsuarioController($id){

			$respuesta = Datos::verUsuarioModel();
 

			foreach($respuesta as $row => $item){
			$idencriptado = Datos::encriptar($item['id']);
			$hash =urlencode($idencriptado);			
			echo'<tr>
				<td>'.$item["Nombre"].'</td>
				<td>'.$item["Apellido1"].'</td>
				<td>'.$item["Direccion"].'</td>
				<td>'.$item["Referencia"].'</td>
				<td>'.$item["Telefono"].'</td>
				<td>'.$item["Nomlocalidad"].'</td>
				<td>'.$item["FechaCorte"].'</td>
				<td><a href="panel.php?modulo=clientes&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver/Editar</button></a></td>
				<td><button type="button" class="btn btn-danger	">Eliminar</button></a></td>
			</tr>';

		}


		}




		#Ver Editar usuario controller
		public function verUsuarioCompletoController($usuario){
			$id = $usuario["ID"];
			$mypassword = Datos::desencriptar($usuario["password"]);
			echo             
			'<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Datos del Cliente
                        </div>
                        <div class="panel-body">
                            
                                 <form role="form" method="post" autocomplete="off">
                                 <div class="row">
                                    <div class="col-lg-4">                                
                                        <div class="form-group">
                                            <label>ID Cliente</label>
                                            <input name="usuarioActualizar" class="form-control" value="'.$usuario["usuario"].'" disabled tabindex="1">
                                            <p class="help-block">Solo acepta minúsculas.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="nombreActualizar" class="form-control" value="'.$usuario["Nombre"].'" required tabindex="4" disabled>
                                            <p class="help-block">Ingresa el/los nombre(s) del cliente.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" name="emailActualizar" class="form-control" value="'.$usuario["Correo"].'" required tabindex="7" disabled>
                                            <p class="help-block">Correo del cliente.</p>
                                        </div>
                                         <div class="form-group">
                                            <label>Localidad</label>
                                            <select name="localidadActualizar" class="form-control" tabindex="10" disabled>
												';
												$localidades = $this->llenarFormLocalidadeUsuarioController($id);
												echo '
                                            </select>
                                        </div>

										<br>
                                       <a href="#"><button type="submit" class="btn btn-primary pull-left hidden-xs hidden-sm hidden-md">Actualizar Datos</button>  </a>
                                       <!--<a href="panel.php?modulo=pagos&action=crear">
                                       <button class="mybtn btn btn-primary pull-left hidden-xs hidden-sm hidden-md">Enviar Pago</button>  
                                       </a>-->
                                </div>

                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>*Contraseña</label>
                                            <input type="text" name="passwordActualizar" class="form-control" value="'.$mypassword.'"tabindex="2" >
                                            <p class="help-block">Ingrsa una contraseña segura.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*Apellido Paterno</label>
                                            <input type="text" name="apellido1Actualizar" class="form-control"  value="'.$usuario["Apellido1"] .'" required tabindex="6" disabled>
                                            <p class="help-block">Solo el apellido paterno.</p>
                                        </div>
                                         <div class="form-group">
                                            <label>*Dirección</label>
                                            <input type="text" name="direccionActualizar" class="form-control" value="'.$usuario["Direccion"] .'" required tabindex="8" disabled>
                                            <p class="help-block">Calle, Número, Colonia, CP.</p>
                                        </div>
                                          <div class="form-group">
                                            <label>*WhatsApp</label>
                                            <input type="text" name="telefonoActualizar" class="form-control" value="'.$usuario["Telefono"] .'" required tabindex="11" >
                                            <p class="help-block">Teléfono o Whatsapp del cliente</p>
                                        </div>

                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label>Estado</label>
                                            <input type="text" name="privilegioActualizar" class="form-control" value="';
                                            	$a = $this->obtenerEstadoController($id);
                                            echo '" required tabindex="11" disabled>
                                            <p class="help-block">Elige correctamente el privilegio.</p>
                                        </div>
                                    <div class="form-group">
                                            <label>Apellido Materno</label>
                                            <input type="text" name="apellido2Actualizar" value="'.$usuario["Apellido2"] .'" class="form-control" tabindex="6" disabled>
                                            <p class="help-block">Este apellido es opcional.</p>
                                        </div>
                                    <div class="form-group">
                                            <label>Referencia</label>
                                            <input type="text" name="referenciaActualizar" class="form-control" value="'.$usuario["Referencia"] .'" required tabindex="9" disabled>
                                            <p class="help-block">Alguna referencia para identificar al cliente.</p>
                                        </div>
                                        <div class="form-group" tabindex="12">
                                            <label>Fecha de Corte</label>

                                        <div class="checkbox">';
											$b = $this->llenarFormCortesUsuarioController($id);
                                        echo'</div>
                                   

                                  
                                </div>

                                </div>

                               

                                

                            </div>
							<a href="#"><button type="submit" class="btn btn-primary pull-left visible-xs visible-sm visible-md">Actualizar Datos</button>  </a>

							<a href="panel.php?modulo=pagos&action=crear"><button class="btn btn-primary pull-left visible-xs visible-sm visible-md">Enviar Pago</button>  </a>


							</form>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->';

            $pagos = Datos::verPagosModel($usuario["ID"], "historialpagos");
            #var_dump($pagos);

            echo '<div class="panel panel-default">
                        <div class="panel-heading">
                           Historial de pagos de '.$usuario["Nombre"].'
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID Cliente</th>
                                            <th>Fecha de pago</th>
                                            <th>Comprobante</th>
                                            <th>Referencia</th>
                                            <th>Estado</th>
                                            <th>Concepto</th>
                                            <th>Observaciones</th>
                                             <th>Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ';

            foreach($pagos as $row => $item){	
            $idencriptado = Datos::encriptar($item["id"]);
            $hash = urlencode($idencriptado);	
            if($item["Estado"]=="Cancelado"){
            	$class="text-danger";
            	$modulo = "cancelaciones";
            }
            elseif ($item["Estado"]=="Pagado") {
            			$class="text-success";
            			$modulo = "facturas";
            		}
            		elseif ($item["Estado"]=="Procesando") {
            					$class="text-primary";
            					$modulo = "pagos";
            				}	
			echo'<tr>
				<td>'.$item["Nombre"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>
					<button type="button" class="btn btn-success btnpago"  id="'.$item["comprobante"].'" data-toggle="modal" data-target="#myModal">Ver imagen</button>
				</td>
				<td>'.$item["Referencia"].'</td>
				<td><p class="'.$class.'">'.$item["Estado"].'</p></td>
				<td>'.$item["concepto"].'</td>
				<td>'.$item["observaciones"].'</td>
				<td><a href="panel.php?modulo='.$modulo.'&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver</button></a></td>

			</tr>';

		}

       echo '
                    				


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->';

		}

		public function validarPagoController($id){

			$idd = Datos::desencriptar($id);
			$respuesta = Datos::validarPagoModel($idd);
			return $respuesta;
			}


		public function pagosPendientesController($idusuario){
			$variable = Datos::pagosPendientesModel($idusuario);

			foreach($variable as $row => $item){
				$idencriptado = Datos::encriptar($item['id']);
				$hash =urlencode($idencriptado);		
				echo'<tr>
					<td>'.$item["Nombre"].'</td>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["Referencia"].'</td>
					<td><p class="text-primary">'.$item["Estado"].'</p></td>
					<td>'.$item["Concepto"].'</td>
					<td>$'.$item["Importe"].'</td>
					<td><a href="panel.php?modulo=pagos&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver</button></a></td>
					</tr>';
				}
			}

		public function pagosRecientesController(){
			$variable = Datos::pagosRecientesModel();


			foreach($variable as $row => $item){
				$idencriptado = Datos::encriptar($item['id']);
				$hash =urlencode($idencriptado);	

				if($item["Estado"]=="Pagado"){
					$modulo = "facturas";
				}
				elseif ($item["Estado"]=="Procesando") {
						$modulo = "pagos";
					}
				elseif ($item["Estado"]=="Cancelado") {
					$modulo = "Cancelaciones";
				}	
				echo'<tr>
					<td>'.$item["Nombre"].'</td>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["Referencia"].'</td>
					<td>'.$item["Estado"].'</td>
					<td>'.$item["NomConcepto"].'</td>
					<td>$'.$item["Importe"].'</td>
					<td><a href="panel.php?modulo='.$modulo.'&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver</button></a></td>
					</tr>';
				}
			}

		public function pagosRealizadosController($idusuario){
			$variable = Datos::pagosRealizadosModel($idusuario);
			
			foreach($variable as $row => $item){
			$idencriptado = Datos::encriptar($item['id']);
			$hash =urlencode($idencriptado);		
				echo'<tr>
					<td>'.$item["Nombre"].'</td>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["Referencia"].'</td>
					<td><p class="text-success">'.$item["Estado"].'</p></td>
					<td>'.$item["Concepto"].'</td>
					<td>$'.$item["Importe"].'</td>
					<td><a href="panel.php?modulo=facturas&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver</button></a></td>
					</tr>';
				}
			}
		
		public function pagosCanceladosController($idusuario){
			$variable = Datos::pagosCanceladosModel($idusuario);
			
			foreach($variable as $row => $item){
			$idencriptado = Datos::encriptar($item['id']);
			$hash =urlencode($idencriptado);		
				echo'<tr>
					<td>'.$item["Nombre"].'</td>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["Referencia"].'</td>
					<td><p class="text-danger">'.$item["Estado"].'</p></td>
					<td>'.$item["Concepto"].'</td>
					<td>$'.$item["Importe"].'</td>
					<td><a href="panel.php?modulo=cancelaciones&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver</button></a></td>
					</tr>';
				}
			}



			public function actualizarPagoController($idController, $varController){

				$id = Datos::desencriptar($idController);
				$validaridpago= Datos::validarPago($id);
				
				if($validaridpago>1){
					#Validar la accicón a ejecutar
					if($varController==4){
						$respuesta = Datos::actualizarPagoModel($id, $varController);
						if($respuesta== true){
							echo '<div class="alert alert-success">
                                El pago se actualizó correctamente.
                            </div>
						<script type="text/javascript">
						  window.setTimeout(function(){

						        // Move to a new location or you can do something else
						        window.location="panel.php?modulo=pagos";

						    }, 2000);
						    </script>


                            ';
						}
					}
					elseif($varController==5){
						$respuesta = Datos::actualizarPagoModel($id, $varController);
						if($respuesta== true){
							echo '<div class="alert alert-danger">
                                El pago se cenceló correctamente.
                            </div>
						<script type="text/javascript">
						  window.setTimeout(function(){

						        // Move to a new location or you can do something else
						        window.location="panel.php?modulo=pagos";

						    }, 2000);
						    </script>


                            ';
						}
					}
					elseif($varController>1){
						echo '<br>Sin acción a ejecutar';					
					}
				 }else{
				 	echo "Error de parámetros";
				 }

			}
			
			
			
			
			public function estadisticaController(){
				
				$clientes = Datos::obtenerClientesModel();
				$fpagadas = Datos::obtenerFacturasModel();
				$fpendientes = Datos::obtenerPendientesModel();
				$tickets = Datos::obtenerTicketsAbiertosModel();

				echo '
				            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa  fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">';echo $clientes["count(*)"]; echo'</div>
                                    <div>Clientes</div>
                                </div>
                            </div>
                        </div>
                        <a href="panel.php?modulo=clientes">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Clientes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">';echo $fpagadas["count(*)"]; echo'</div>
                                    <div>Facturas Pagadas</div>
                                </div>
                            </div>
                        </div>
                        <a href="panel.php?modulo=facturas">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Facturas</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">';echo $fpendientes["count(*)"]; echo'</div>
                                    <div>Pagos Pendientes</div>
                                </div>
                            </div>
                        </div>
                        <a href="panel.php?modulo=pagos">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Pagos</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">';echo $tickets["count(*)"]; echo'</div>
                                    <div>Tickets de Soporte</div>
                                </div>
                            </div>
                        </div>
                        <a href="panel.php?modulo=tickets">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Tickets</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

				';



			}

			public function obtenerTicketsController($idusuarioController){
				$respuesta = Datos::obtenerTicketsModel($idusuarioController);
				

				foreach($respuesta as $row => $item){
				$idencriptado= Datos::encriptar($item["id"]);
				$hash = urlencode($idencriptado);
					if($item["estado"]==1){
						$estado="<p class='text-success'>Abierto</p>";
					}else{
						$estado="<p class='text-danger'>Cerrado</p>";
					}

					if($item["prioridad"]==1){
						$prioridad = "Baja";
					}elseif($item["prioridad"]==2){
						$prioridad = "Media";
					}elseif($item["prioridad"]==3){
						$prioridad = "Alta";
					}

				echo'<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$prioridad.'</td>
					<td>'.$item["asunto"].'</td>
					<td>'.$item["fecha"].'</td>
					<td>'.$estado.'</td>
					<td><a href="panel.php?modulo=tickets&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver</button></a></td>
					</tr>';
				}



			}

			public function resummenTicketcontroller($idController, $estado){
				$respuesta = Datos::resummenTicketModel($idController);


				if ($respuesta == 0){ echo 'nada';}
				foreach($respuesta as $row => $item){
					if($item["clase"]==1){
						$clase= 'alert alert-info respuesta';
					}elseif ($item["clase"]==0) {
						$clase= 'alert alert-success';
					}
					echo'
					  <div class="'.$clase.'">
					  <b>'.$item["Nombre"].' '.$item["Apellido1"].'</b> escribió el '.$item["fecha"].'</p>
					  '.$item["texto"].'
					 </div>
					';
					}
					if ($estado==1){
						echo '
							<form rel="form" method="post" autocomplete="off" >
								<div class="form-group">
                                    <label>Responder Ticket:</label>
                                        <textarea class="form-control" rows="3" name="respuesta"></textarea>
                                    </div>
                                    
                                   <a href="panel.php?modulo=tickets&action=editar&id='.$idController.'&var=0"> <button type="button" class="btn btn-danger">Cerrar Ticket</button></a>
                                    <button type="submit" class="btn btn-primary">Enviar Comentario</button>
							</form>
						';
				}
			}



			public function cerrarTicketController($idTicket){
				#validar si el ticket existe
				$valticket = Datos::validarTicketModel($idTicket);

				if($valticket == 1){
					 $respuesta = Datos::cerrarTicketModel($idTicket);

					 if($respuesta==1){
					 	echo '
						<div class="alert alert-success">
							Ticket cerrado correctamente.
						</div>
						<script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php?modulo=tickets";

						    }, 1000);
						    </script>
					 		';
					 }else{
					 	echo "Error en la consulta";
					 }
				}else{
					echo "Error de parámetros";
				}
			}



			public function mensajeTicketController($idTicket,  $idUsuario, $mensaje, $clase){
				$idencriptado = Datos::encriptar($idTicket);
				$hash = urldecode($idencriptado);
				$nmensaje = $this->saltoLinea($mensaje);  
				$respuesta = Datos::mensajeTicketModel($idTicket, $idUsuario, $nmensaje, $clase);
				 if($respuesta==1){
				 	echo '
						<script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php?modulo=tickets&action=editar&id='.$hash.'&a=1";

						    }, 0);
						    </script>
					 		';
				 }					
			}

			public function crearTicketController($idUsuario, $asunto, $prioridad, $mensaje, $clase){
				$modulo = "Ticket";
				$idu= $idUsuario;
				$as= $asunto;
				$p = $prioridad;
				$text = $this->saltoLinea($mensaje);
				$c =$clase;
				#primero se inserta el ticket y se obtiene el último ID de la tabla ticket
				$idticket = Datos::crearTicketModel($idUsuario, $asunto, $prioridad, $mensaje, $clase);
				$idencriptado = Datos::encriptar($idticket);
				$hash = urlencode($idencriptado);
				$respuesta = Datos::mensajeTicketModel($idticket, $idu, $text, $c);
				 if($respuesta==1){	
					$mydatos = Datos::detalleSistema();
					if($mydatos["nTickets"]==1){
						$correo = $mydatos["eSistema"];
						$notificacion = $this->emailalerta($correo, $modulo, $idticket);
					}
				 	echo '
						<script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php?modulo=tickets&action=ver&id='.$hash.'";

						    }, 0);
						    </script>
					 		';
							
					
				 }
				 else{
				 	echo "error";
				 }					
			}

			public function conceptosController(){
				$respuesta=Datos::conceptosModel();
					foreach($respuesta as $row => $item){
					echo'
					<option value="'.$item["id"].'">'.$item["NomConcepto"].'</option>
					';
					}
			}

			public function crearPagoController($idusuario, $referencia, $estadopago, $concepto, $importe, $imagen, $mensaje){
				$mymodulo = "Pago Pendiente";
				if($estadopago==3){
					 $modulo = "pagos";
				}
				elseif ($estadopago==4) {
					$modulo = "facturas";
				}
				elseif($estadopago==5){
					$modulo = "cancelaciones";
				}

				$respuesta = Datos::crearPagoModel($idusuario, $referencia, $estadopago, $concepto, $importe, $imagen, $mensaje);
				
				if($respuesta==1){
					$idfactura =  Datos::ultimafactura();
					$idencriptado = Datos::encriptar($idfactura);
					$hash =urlencode($idencriptado);
					$mydatos = Datos::detalleSistema();
					if($mydatos["nPagos"]==1){
						$correo = $mydatos["eSistema"];
						$notificacion = $this->emailalerta($correo, $mymodulo, $idfactura);
					}
					
					
					echo '
						<div class="alert alert-success">
							Pago creado correctamente.
						</div>
						<script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php?modulo='.$modulo.'&action=ver&id='.$hash.'";

						    }, 1000);
						    </script>
					 		';
				 }else{
				 	echo '
						<div class="alert alert-success">
							Error en datos.
						</div>';
				 }
				
			}



		function saltoLinea($str) {
  			return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
		}
		
		
		public function emailalerta($correo, $modulo, $idobjeto){
			// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
			$para = $correo;
			$asunto = 'Notificación del sistema';
			$cabecera  = 'MIME-Version: 1.0' . "\r\n";
			$cabecera .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$cabecera .= 'From: InternetYA <contacto@internetya.com.mx>' . "\r\n";
			$cabecera .= 'Bcc: <contacto@internetya.com.mx>' . "\r\n"; 

			$email_message = '
			
			<!DOCTYPE html>
			<html lang="es">
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
				<link type="text/css" href="http://gubynetwork.com/docs/cclientes.css" rel="stylesheet"  >
				<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
			</head>
			<body><br/>
			<div class="container">
				<div class="mycont">
				<div class="row">
					<div class="col-md-12 pull-left">
						<h2>Notificación de '.$modulo.'</h2>
					</div>
				</div>
				
				</div>
				<hr>
				
				<p>Estimado Administrador se ha generado un '.$modulo.' con ID: <b>'.$idobjeto.'</b>, favor de revisarlo desde la consola de administración del sistema.
				
				</p>
				<br><br>
				<p>------------------------------<br/>
				www.internetya.com.mx <br>
				Benito Juarez 242 Col. Centro Zempoala,Veracruz.<br>
				contacto@internetya.com.mx<br>
				045 2961076448
				</div>
			</body>
			</html>
			'; 


			
			mail($para, $asunto, $email_message, $cabecera);	 

		}

}

 ?>


