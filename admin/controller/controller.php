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

		public function ingresoAdminController(){
			
			if(isset($_POST["usuarioIngreso"]) and isset($_POST["passwordIngreso"]) and $_POST["usuarioIngreso"] != "" and $_POST["passwordIngreso"] != ""   ){

				$encriptar = Datos::encriptar($_POST["passwordIngreso"]);
				$datosController = array( "usuario" => $_POST["usuarioIngreso"], 
									      "password" => $encriptar);
				$respuesta = Datos::ingresoAdminModel($datosController, "usuarios");
				if($respuesta=="no"){
				 echo "Datos incorrectos";
				}
				else{
					session_start();
					$_SESSION["validar"] = true;
					$_SESSION["id"] = $respuesta["id"];
					header("location:panel.php");
				}
			}

		}
		
		public function tablaLocalidades(){
			$respuesta = Datos::obtenerLocalidadesModel();
			foreach($respuesta as $row => $item){

				echo'<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["NomLocalidad"].'</td>
					<td>'.$item["Observacion"].'</td>
					<td><a href="panel.php?modulo=localidades&action=ver&id='.$item["id"].'"><button type="button" class="btn btn-success">Ver/editar</button></a></td>
					<td><a href="#"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
					</tr>';
				}
 
		}
		
		public function crearLocalidadController($localidad,$referencia){
			$respuesta = Datos::crearLocalidadModel($localidad,$referencia);
			if($respuesta==1){
				echo '<script type="text/javascript">window.setTimeout(function(){   
						window.location="panel.php?modulo=localidades&action=editar&edit=1"
						},); 
			        </script>';
				
				/*
				echo'
				<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Se creó la localidad correctamente. 
                </div>
				';*/
			}else{
				echo '
					<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Ups! Algo salió mal. Probablemente la localidad ya existe.
                    </div>
				';
			}
		}
		
		public function actualizarLocalidadController($id,$localidad,$referencia){
			$respuesta = Datos::actualizarLocalidadModel($id,$localidad,$referencia);
			if($respuesta==1){
				echo '<script type="text/javascript">window.setTimeout(function(){   
						window.location="panel.php?modulo=localidades&action=editar&edit=1"
						},); 
			        </script>';
				
				/*
				echo'
				<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Se creó la localidad correctamente. 
                </div>
				';*/
			}else{
				echo '
					<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Ups! Algo salió mal. Probablemente la localidad ya existe.
                    </div>
				';
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
			$cortes = Datos::obtenerCortesModel();
			$corteUsuario = Datos::obtenerCorteUsuarioModel($idController);
			echo '';
			$contador=1;
			foreach ($cortes as $row) {
				echo "<div class='checkbox'><label><input type='checkbox' id='fcorte".$contador."' name='corteActualizar' value='".$row[0]; 
	
				if($row[0]==$corteUsuario[0]){
					echo "' checked ";
				} else{
					echo "'";
				}

				echo ">".$row[1]. "</label></div>";

				$contador = $contador +1;
			}
		}

		public function obtenerEstadoController($idcontroller){
			
			$respuesta = Datos::obtenerEstadoModel($idcontroller);
			if($respuesta[0]==1){
				echo'
				<option value="1" selected="selected">Activado</option>
				<option value="0">Desactivado</option>
				';
			}else{
				echo'
				<option value="1" >Activado</option>
				<option value="0" selected="selected">Desactivado</option>
				';
			}
		}

		
		


		#Llenar Formulario FechasDeCorte
		#-------------------------
		public function llenarFormFechaCortesController(){
			$fechas = Datos::obtenerFechasModel();
			$contador=1;
			foreach ($fechas as $row) {
				echo "<div class='checkbox'><label><input type='checkbox' id='fcorte".$contador."' name='corteCrear' value='".$row[0] ." required
				'     >".$row[1]."</label></div>";
				$contador = $contador + 1;
  
			}
		}



		public function getlastUserController(){
			
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
					$normal=$_POST["passwordCrear"];
					$encriptar = Datos::encriptar($_POST["passwordCrear"]);

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
				
				if($respuesta==1){
					//Eenvío de correo.
					$config = Datos::sistemaModel();
					if($config["nClientes"]==1){
						$r = $this-> nclientemail($datosController, $normal); 
					}
					
					
					echo '<script type="text/javascript">window.setTimeout(function(){   
			          	  window.location="panel.php?modulo=clientes"
			        	}, 2000); 
			        	</script>';
				}
				else{	
					echo $respuesta;
				}

			}
		}


		public function actualizarUsuarioController($datos){
			$id = $datos["id"];
			$idencriptado = Datos::encriptar($id);
			$hash =urlencode($idencriptado);	
			$update = Datos::actualizarUsuarioModel($datos);
			if($update==1){
				echo '<script type="text/javascript">window.setTimeout(function(){   
          	  window.location="panel.php?modulo=clientes&action=editar&id='.$hash.'&var=1"
        	});
        	</script>';
			}

		}


		#Ver Usuarios
		#---------------------------------

		public function verUsuarioController($idusuario){

			$respuesta = Datos::verUsuarioModel($idusuario);
 

			foreach($respuesta as $row => $item){
			$idencriptado = Datos::encriptar($item['id']);
			$hash =urlencode($idencriptado);			
			echo'<tr>
				<td>'.$item["usuario"].'</td>
				<td>'.$item["Nombre"].'</td>
				<td>'.$item["Apellido1"].'</td>
				<td>'.$item["Direccion"].'</td>
				<td>'.$item["Referencia"].'</td>
				
				<td>'.$item["Nomlocalidad"].'</td>
				<td>'.$item["FechaCorte"].'</td>
				<td><a href="panel.php?modulo=clientes&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver/Editar</button></a></td>

				<!--<td><a href="panel.php?modulo=clientes&action=editar&id='.$hash.'
				&delete=1"><button type="button" class="btn btn-danger	">Eliminar</button>--> </a></td>
				 
				
				<td><a href="#"><button type="button" class="btn btn-danger btneliminar" data-toggle="modal" data-target="#notificacion" id="'.$hash.'">Eliminar</button></a></td>
			</tr>';

			}


		}


		public function verPerfilController($usuario){
			$id = $usuario["ID"];
			$mypassword = rtrim(Datos::desencriptar($usuario["password"]));	
			
			echo             
			'<div class="row">	
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Ver/Editar Cliente
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                 <form role="form" method="post" autocomplete="off">
                                    <div class="col-lg-4">                                
                                        <div class="form-group">
                                            <label>*ID Cliente</label>
                                            <input name="usuarioActualizar" class="form-control" value="'.$usuario["usuario"].'" disabled tabindex="1">
                                            <p class="help-block">Solo acepta minúsculas.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*Nombre</label>
                                            <input type="text" name="nombreActualizar" class="form-control" value="'.$usuario["Nombre"].'" required tabindex="4">
                                            <p class="help-block">Ingresa el/los nombre(s) del cliente.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*E-mail</label>
                                            <input type="email" name="emailActualizar" class="form-control" value="'.$usuario["Correo"].'" required tabindex="7">
                                            <p class="help-block">Correo del cliente.</p>
                                        </div>
                                         <div class="form-group">
                                            <label>Localidad</label>
                                            <select name="localidadActualizar" class="form-control" tabindex="10">
												';
												$localidades = $this->llenarFormLocalidadeUsuarioController($id);
												echo '
                                            </select>
                                        </div>


                                      
                                </div>

                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>*Contraseña</label>
                                            <input type="text" name="passwordActualizar" class="form-control" value="'.$mypassword.'"tabindex="2">
                                            <p class="help-block">Ingrsa una contraseña segura.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*Apellido Paterno</label>
                                            <input type="text" name="apellido1Actualizar" class="form-control"  value="'.$usuario["Apellido1"] .'" required tabindex="6">
                                            <p class="help-block">Solo el apellido paterno.</p>
                                        </div>
                                         <div class="form-group">
                                            <label>*Dirección</label>
                                            <input type="text" name="direccionActualizar" class="form-control" value="'.$usuario["Direccion"] .'" required tabindex="8">
                                            <p class="help-block">Calle, Número, Colonia, CP.</p>
                                        </div>
                                          <div class="form-group">
                                            <label>*Whhatsapp</label>
                                            <input type="text" name="telefonoActualizar" class="form-control" value="'.$usuario["Telefono"] .'" required tabindex="11">
                                            <p class="help-block">Teléfono o Whatsapp del cliente</p>
                                        </div>

                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label>Estado</label>
                                            <select name="estadoActualizar" class="form-control" tabindex="3">
                                               '; 
                                               	$a = $this->obtenerEstadoController($id);
                                               echo'
                                            </select>
                                            <p class="help-block">Elige correctamente el privilegio.</p>
                                        </div>
                                    <div class="form-group">
                                            <label>Apellido Materno</label>
                                            <input type="text" name="apellido2Actualizar" value="'.$usuario["Apellido2"] .'" class="form-control" tabindex="6">
                                            <p class="help-block">Este apellido es opcional.</p>
                                        </div>
                                    <div class="form-group">
                                            <label>Referencia</label>
                                            <input type="text" name="referenciaActualizar" class="form-control" value="'.$usuario["Referencia"] .'" required tabindex="9">
                                            <p class="help-block">Alguna referencia para identificar al cliente.</p>
                                        </div>
                                        <div class="form-group" tabindex="12">
                                            <label>Fecha de Corte</label>

                                        <div class="checkbox">';
											$b = $this->llenarFormCortesUsuarioController($id);
                                        echo'</div>
                                   

                                  
                                </div></div>
                                <!-- /.col-lg-6 (nested) -->

								
                                
			   				<button type="submit" class="btn btn-primary pull-left mybtn">Actualizar Cliente</button>   
                                </form>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->';
}


		#Ver Editar usuario controller
		public function verUsuarioCompletoController($usuario){
			$id = $usuario["ID"];
			$mypassword = rtrim(Datos::desencriptar($usuario["password"]));	
			echo             
			'<div class="row">	
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Ver/Editar Cliente
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                 <form role="form" method="post" autocomplete="off">
                                    <div class="col-lg-4">                                
                                        <div class="form-group">
                                            <label>*ID Cliente</label>
                                            <input name="usuarioActualizar" class="form-control" value="'.$usuario["usuario"].'" disabled tabindex="1">
                                            <p class="help-block">Solo acepta minúsculas.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*Nombre</label>
                                            <input type="text" name="nombreActualizar" class="form-control" value="'.$usuario["Nombre"].'" required tabindex="4">
                                            <p class="help-block">Ingresa el/los nombre(s) del cliente.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*E-mail</label>
                                            <input type="email" name="emailActualizar" class="form-control" value="'.$usuario["Correo"].'" required tabindex="7">
                                            <p class="help-block">Correo del cliente.</p>
                                        </div>
                                         <div class="form-group">
                                            <label>Localidad</label>
                                            <select name="localidadActualizar" class="form-control selectpicker" tabindex="10">
												';
												$localidades = $this->llenarFormLocalidadeUsuarioController($id); 
												echo '
                                            </select>
                                        </div>


                                      
                                </div>

                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>*Contraseña</label>
                                            <input type="text" name="passwordActualizar" class="form-control" value="'.$mypassword.'"tabindex="2">
                                            <p class="help-block">Ingrsa una contraseña segura.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*Apellido Paterno</label>
                                            <input type="text" name="apellido1Actualizar" class="form-control"  value="'.$usuario["Apellido1"] .'" required tabindex="6">
                                            <p class="help-block">Solo el apellido paterno.</p>
                                        </div>
                                         <div class="form-group">
                                            <label>*Dirección</label>
                                            <input type="text" name="direccionActualizar" class="form-control" value="'.$usuario["Direccion"] .'" required tabindex="8">
                                            <p class="help-block">Calle, Número, Colonia, CP.</p>
                                        </div>
                                          <div class="form-group">
                                            <label>*Whhatsapp</label>
                                            <input type="text" name="telefonoActualizar" class="form-control" value="'.$usuario["Telefono"] .'" required tabindex="11">
                                            <p class="help-block">Teléfono o Whatsapp del cliente</p>
                                        </div>

                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label>Estado</label>
                                            <select name="estadoActualizar" class="form-control" tabindex="3">
                                               '; 
                                               	$a = $this->obtenerEstadoController($id);
                                               echo'
                                            </select>
                                            <p class="help-block">Elige correctamente el privilegio.</p>
                                        </div>
                                    <div class="form-group">
                                            <label>Apellido Materno</label>
                                            <input type="text" name="apellido2Actualizar" value="'.$usuario["Apellido2"] .'" class="form-control" tabindex="6">
                                            <p class="help-block">Este apellido es opcional.</p>
                                        </div>
                                    <div class="form-group">
                                            <label>Referencia</label>
                                            <input type="text" name="referenciaActualizar" class="form-control" value="'.$usuario["Referencia"] .'" required tabindex="9">
                                            <p class="help-block">Alguna referencia para identificar al cliente.</p>
                                        </div>
                                        <div class="form-group" tabindex="12">
                                            <label>Fecha de Corte</label>

                                        <div class="checkbox">';
											$b = $this->llenarFormCortesUsuarioController($id);
                                        echo'</div>
                                   

                                  
                                </div></div>
                                <!-- /.col-lg-6 (nested) -->

								
                                
			   				<button type="submit" class="btn btn-primary pull-left mybtn">Actualizar Cliente</button>   
                                </form>

                            </div>
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
                                            <th>Nombre</th>
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
					<button type="button" class="btn btn-success btnpago"  id="'.$item["comprobante"].'" data-toggle="modal" data-target="#myModal">Ver imagen</button></td>
				
				<td>'.$item["Referencia"].'</td>
				<td><p class="'.$class.'">'.$item["Estado"].'</p></td>
				<td>'.$item["Concepto"].'</td>
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


		public function pagosPendientesController(){
			$variable = Datos::pagosPendientesModel();


			foreach($variable as $row => $item){
				$idencriptado = Datos::encriptar($item['id']);
				$hash =urlencode($idencriptado);

				$idencriptadoc = Datos::encriptar($item['idcliente']);
				$hashc =urlencode($idencriptadoc);


				echo'<tr>
					<td>'.$item["id"].'</td>
					<td><b><a href="panel.php?modulo=clientes&action=ver&id='.$hashc.'">'.$item["usuario"].'</a></b></td>
					<td>'.$item["Nombre"].'</td>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["Referencia"].'</td>
					<td><p class="text-primary">'.$item["Estado"].'</p></td>
					<td>'.$item["Concepto"].'</td>
					<td>$'.$item["Importe"].'</td>
					<td><a href="panel.php?modulo=pagos&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver/Editar</button></a></td>
					</tr>';
				}
			}

		public function pagosRecientesController(){
			$variable = Datos::pagosRecientesModel();
			$modulo="";
			
			foreach($variable as $row => $item){
				$idencriptado = Datos::encriptar($item['id']);
				$hash =urlencode($idencriptado);	

				if($item['Estado']=="Pagado"){
					$modulo = "facturas";
					$class= "text-success";
				}
				elseif ($item['Estado']=="Procesando") {
						$modulo = "pagos";
						$class= "text-primary";
					}
				elseif ($item['Estado']=="Cancelado") {
					$modulo = "cancelaciones";
					$class= "text-danger";
				}	
				echo'<tr>
					<td>'.$item["id"].'</td>
					<td><span title="'.$item["usuario"].'">'.$item["Nombre"].'</span></td>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["Referencia"].'</td>
					<td><p class="'.$class.'">'.$item["Estado"].'</p></td>
					<td>'.$item["concepto"].'</td>
					<td>$'.$item["Importe"].'</td>
					<td><a href="panel.php?modulo='.$modulo.'&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver</button></a></td>
					</tr>';
				}
			}

		public function pagosRealizadosController(){
			$variable = Datos::pagosRealizadosModel();
			
			foreach($variable as $row => $item){

			$idencriptado = Datos::encriptar($item['id']);
			$hash =urlencode($idencriptado);
			$idencriptadoc = Datos::encriptar($item['idcliente']);
			$hashc =urlencode($idencriptadoc);

				echo'<tr>
					<td>'.$item["id"].'</td>
					<td><b><a href="panel.php?modulo=clientes&action=ver&id='.$hashc.'">'.$item["usuario"].'</a></b></td>
					<td>'.$item["Nombre"].'</td>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["Referencia"].'</td>
					<td><p  class="text-success">'.$item["Estado"].'</p></td>
					<td>'.$item["Concepto"].'</td> 
					<td>$'.$item["Importe"].'</td>
					<td><a href="panel.php?modulo=facturas&action=ver&id='.$hash.'"><button type="button" class="btn btn-success">Ver</button></a></td>
					</tr>';
				}
			}
		
		public function pagosCanceladosController(){
			$variable = Datos::pagosCanceladosModel();
			
			foreach($variable as $row => $item){
			$idencriptado = Datos::encriptar($item['id']);
			$hash =urlencode($idencriptado);	
			$idencriptadoc = Datos::encriptar($item['idcliente']);
			$hashc =urlencode($idencriptadoc);	
				echo'<tr>
					<td>'.$item["id"].'</td>
					<td><b><a href="panel.php?modulo=clientes&action=ver&id='.$hashc.'">'.$item["usuario"].'</a></b></td>
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
							echo '<div class="alert alert-success">
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

			public function obtenerTicketsController(){
				$respuesta = Datos::obtenerTicketsModel();

				foreach($respuesta as $row => $item){
					$idencriptado = Datos::encriptar($item["idusuario"]);
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
					<td><b><a href="panel.php?modulo=clientes&action=ver&id='.$hash.'">'.$item["usuario"].'</a></b></td>
					<td>'.$item["nombre"].'</td>
					<td>'.$prioridad.'</td>
					<td>'.$item["asunto"].'</td>
					<td>'.$item["fecha"].'</td>
					<td>'.$estado.'</td>
					<td><a href="panel.php?modulo=tickets&action=ver&id='.$item["id"].'"><button type="button" class="btn btn-success">Ver</button></a></td>
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
						<div class="alert alert-danger">
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
				$nmensaje = $this->saltoLinea($mensaje);  
				$respuesta = Datos::mensajeTicketModel($idTicket, $idUsuario, $nmensaje, $clase);
				 if($respuesta==1){
				 	echo '
						<script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php?modulo=tickets&action=editar&id='.$idTicket.'&a=1";

						    }, 0);
						    </script>
					 		';
				 }					
			}

			public function crearTicketController($idUsuario, $asunto, $prioridad, $mensaje, $clase){
				$idu= $idUsuario;
				$as= $asunto;
				$p = $prioridad;
				$text = $this->saltoLinea($mensaje);
				$c =$clase;
				#primero se inserta el ticket y se obtiene el último ID de la tabla ticket
				$idticket = Datos::crearTicketModel($idUsuario, $asunto, $prioridad, $mensaje, $clase);
				echo $idticket;
				$respuesta = Datos::mensajeTicketModel($idticket, $idu, $text, $c);
				 if($respuesta==1){
				 	echo '
						<script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php?modulo=tickets&action=ver&id='.$idticket.'";

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
				if($estadopago==3){
					 $modulo = "pagos";
				}
				elseif ($estadopago==4) {
					$modulo = "facturas";
				}
				elseif($estadopago==5){
					$modulo = "cancelaciones";
				}

				$respuesta = Datos::crearPagoModel($idusuario, $referencia, $estadopago, $concepto, $importe,
					$imagen, $mensaje);
				
				if($respuesta==1){
					$idfactura =  Datos::ultimafactura();
					$idencriptado = Datos::encriptar($idfactura);
					$hash =urlencode($idencriptado);
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
				 }
				
			}

			public function eliminarUsuarioController($idusuario){
				$iddesencriptado = Datos::desencriptar($idusuario);
				$respuesta = Datos::eliminarUsuarioModel($iddesencriptado);

				if($respuesta==4){
						echo '
						<div class="alert alert-success">
							Se eliminó el cliente correctamente.
						</div>
						<script type="text/javascript">
						  window.setTimeout(function(){
						        window.location="panel.php?modulo=clientes";

						    }, 1000);
						    </script>
					 		';
				}
			}

		public function sistemaController(){
			$respuesta  = Datos::sistemaModel();
				echo '
				<h3 class="page-header">Panel de configuración</h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Configuraciones generales del sistema
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" method="post" autocomplete="off">
                                    <div class="col-lg-6">

                                        <div class="checkbox">
                                            <label>
                                                <input id="ntickets" name="ntickets" type="checkbox" value="';
                                                echo $respuesta["nTickets"];
                                                echo '"';
                                                if($respuesta["nTickets"]==1){
                                                	echo 'checked>';
                                                }else{
                                                	echo '>';
                                                }
                                               echo 'Activar notificaciones por correo de tickets.
                                            </label>
                                            <label>
                                                <input id="npagos" name="npagos" type="checkbox" value="';
                                                echo $respuesta["nPagos"];
                                                echo '"';
                                                if($respuesta["nPagos"]==1){
                                                	echo 'checked>';
                                                }else{
                                                	echo '>';
                                                }
                                            echo 'Activar notificaciones por correo de pagos.
                                            </label>
                                        </div>
                                         <div class="form-group">
                                            <label>Correo del sistema</label>
                                            <input class="form-control" name="esistema" type="email" value="'.$respuesta["eSistema"].'"  required>
                                            <p class="help-block">A este correo llegarán todas las notificaciones.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Mensaje de Aviso</label>
                                            <textarea class="form-control" name="txtaviso" rows="3" >
                                            '.$respuesta["txtAviso"].'
                                            </textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Actualizar</button>
										<a href="panel.php?modulo=localidades"><button type="button" class="btn btn-success">Gestionar Localidades</button></a>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="checkbox">
                                                <label>
                                                <input id="ncliente" name="ncliente" type="checkbox" value="';
                                                echo $respuesta["nClientes"];
                                                echo '"';
                                                if($respuesta["nClientes"]==1){
                                                	echo 'checked>';
                                                }else{
                                                	echo '>';
                                                }

                                                echo 'Enviar datos por correo a nuevos clientes.
                                                </label>
                                                <label>
                                                    <input id="naviso" name="naviso" type="checkbox" value="';

                                                echo $respuesta["nAviso"];
                                                echo '"';
                                                if($respuesta["nAviso"]==1){
                                                	echo 'checked>';
                                                }else{
                                                	echo '>';
                                                }
                                                echo 'Mostrar aviso en panel de clientes.
                                                </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre comercial</label>
                                            <input class="form-control" name="nsistema" type="text" value="'.$respuesta["nSistema"].'" required>
                                            <p class="help-block">Por favor escriba el nombre de su empresa.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Detalles Bancarios</label>
                                            <textarea class="form-control" name="txtbancarios" rows="3">
                                            '.$respuesta["txtBancarios"].'
                                            </textarea>
                                        </div>
                                    </div>   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
		}



		public function actualizarSistemaController($datos){
			$respuesta = Datos::actualizarSistemaModel($datos);
			if ($respuesta==1){
				echo '
				<script type="text/javascript">
					window.setTimeout(function(){
					window.location="panel.php?modulo=config&action=editar";
				},0);
				</script>
				';
			}
		}



		function saltoLinea($str) {
  			return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
		}  
		
		
		public function nclientemail($datos, $normal){
			// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
			$para = $datos["email"];
			$asunto = "Datos de acceso InternetYA";
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
						<h2>Bienvenid@ a www.internetya.com.mx</h2>
					</div>
				</div>
				
				</div>
				<hr>
				
				<p>Estimad@ '.$datos["nombre"] . ' '.$datos["apellido1"] .' gracias por formar parte del grupo selecto de clientes de <b>InternetYA!</b>, a continuación
				le compartimos los datos de acceso a nuestro Sistema de Administración de Pagos en donde usted
				podrá gestionar los pagos de sus servicios y crear peticiones de soporte a través del sistema de Tickets.
				</p>
				
				<b>Usuario:</b> '.$datos["usuario"].' <br/>
				<b>Contraseña: </b> '.$normal.'<br/>
				<b>Acceso a Clientes: </b> https://internetya.com.mx/clientes/  <br>  <br>  <br>
				Att: El equipo de Internet YA!
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


