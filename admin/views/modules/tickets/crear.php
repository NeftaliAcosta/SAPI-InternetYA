<?php 
	if(isset($_POST["usuarioTicket"])){
		$idusuario = $_POST["usuarioTicket"];
		$asunto = $_POST["asuntoTicket"];
		$prioridad = $_POST["prioridadTicket"];
		$mensaje = $_POST["mensajeTicket"];
		$clase = 0;

		$instancia = new MvcController();
		$instancia -> crearTicketController($idusuario, $asunto, $prioridad, $mensaje, $clase);
	}
 ?>


		<div class="panel panel-default">
                        <div class="panel-heading">
                            Crear nuevo ticket
                        </div>
                        <div class="panel-body">
							<form role="form" method="post" autocomplete="off">
                            <div class="row">
                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ID Cliente:</label>
                                            <select name="usuarioTicket" class="form-control selectpicker" data-live-search="true"name>
                                                
										<?php 
										$a = Datos::usuariosTicketsModel();
							 			foreach($a as $row => $item){		
											echo '<option value="'.$item["id"].'">'.$item["usuario"].'</option>';
											}
									 	?>
                                            </select>
                                        </div>
                                  
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-4">
	                                <div class="form-group">
	                                    <label>Asunto:</label>
	                                    <input name="asuntoTicket" class="form-control" required>
	                                </div>
                                </div>
                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Prioridad:  </label>
                                            <select name="prioridadTicket" class="form-control selectpicker">
                                                <option value="1">Baja</option>
                                                <option value="2">Media</option>
                                                <option value="3">Alta</option>
                                            </select>
                                        </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <div class="row">
                            	<div class="col-lg-12">
                            		<div class="form-group">
                                            <label>Mensaje</label>
                                            <textarea  name="mensajeTicket" id="redactor" class="form-control" rows="3" ></textarea>

                                            

                                        </div>
                            	</div>
                            </div>
                            <!-- /.row (nested) -->
                             <button type="sumbit" class="btn btn-primary">Enviar mensaje</button>
                             </form>
                        </div>

                        <!-- /.panel-body -->
                    </div>