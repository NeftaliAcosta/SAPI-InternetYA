<?php
	if(isset( $_GET['id'])){
		$id = $_GET['id'];
		$localidad = Datos::selectlocalidad($id);
		echo '
				<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Actualizar Localidad
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" autocomplete="off"> 
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
                                            <label>*Localidad</label>
                                            <input class="form-control" name="nlocalidad" value="';
											echo $localidad["NomLocalidad"];
											echo'" required>
                                            <p class="help-block">Escriba la nueva localidad</p>
                                        </div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
                                            <label>Comentarios(Opcional)</label>
                                            <input class="form-control" name="nreferencia" value="'; 
											echo $localidad["Observacion"];
											echo'">
                                            <p class="help-block">Referencia de la localidad</p>
                                        </div>
									</div>

								</div>
								<a href="panel.php?modulo=localidades"><button type="button" class="btn btn-danger">Cancelar</button></a>
								<button type="submit" class="btn btn-primary">Actualizar</button>
								
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 --> 
            </div> 
		
		';



	
		
			if(isset($_POST["nlocalidad"])){
				$localidad = $_POST["nlocalidad"];
				if(isset($_POST["nreferencia"])){
						$referencia = $_POST["nreferencia"];
					}else{
						$referencia = "Ninguna";
					}
					$instancia = new MvcController();
					$instancia -> actualizarLocalidadController($id,$localidad, $referencia);
				}
	}else{
		echo '
			<div class="alert alert-danger">
                Ups! Algo salió mal. Parámetros incorrectos.
            </div>
		';
	}

	
?>		
		
