<?php
	if(isset($_POST["localidad"])){
		$localidad = $_POST["localidad"];
	if(isset($_POST["referencia"])){
			$referencia = $_POST["referencia"];
		}else{
			$referencia = "Ninguna";
		}
		$instancia = new MvcController();
		$instancia -> crearLocalidadController($localidad, $referencia);
	}
	
	if(isset( $_GET['edit'])){
		echo '
		<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Se creó la localidad correctamente. 
                </div>
		';
	}

?>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Agregar Localidad
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" autocomplete="off"> 
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
                                            <label>*Localidad</label>
                                            <input class="form-control" name="localidad" required>
                                            <p class="help-block">Escriba la nueva localidad</p>
                                        </div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
                                            <label>Comentarios(Opcional)</label>
                                            <input class="form-control" name="referencia">
                                            <p class="help-block">Referencia de la localidad</p>
                                        </div>
									</div>

								</div>
								<a href="panel.php?modulo=config"><button type="button" class="btn btn-success">Regresar a Configuracion</button></a>
								<button type="submit" class="btn btn-primary">Agregar</button>
								
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 --> 
            </div> 
			


    <div class="panel panel-default">
                        <div class="panel-heading">
                           Localidades del sistema
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!--<div class="table-responsive" >-->
							 
                                 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables"  >
                                    <thead>
                                        <tr>
                                            <th>ID Localidad</th>
                                            <th>Nombre</th>
											<th>Referencia</th>
                                            <th>Ver/Editar</th>
											<th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$a = new MvcController();
											$a -> tablaLocalidades();
										?>
                                    </tbody>
                                </table>
								
                           <!-- </div>-->
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->