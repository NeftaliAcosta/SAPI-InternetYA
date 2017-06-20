 <?php 

 $idusuario = $_SESSION["id"]; 
	if( isset($_POST["referenciaPago"])  && isset($_POST["conceptoPago"]) && isset($_POST["importePago"]) &&  isset($_POST["mensajePago"])){
		
		if (( ($_FILES["archivo-a-subir"]["type"] == "image/gif")
			  || ($_FILES["archivo-a-subir"]["type"] == "image/png")
			  || ($_FILES["archivo-a-subir"]["type"] == "image/jpeg")
			  || ($_FILES["archivo-a-subir"]["type"] == "image/jpg"))
			  && ($_FILES["archivo-a-subir"]["size"] < 9250000000))
			{
				$target_path = "../imagenes/";
				$strimg =basename( $_FILES['archivo-a-subir']['name']); 
				$target_path = $target_path . basename( $_FILES['archivo-a-subir']['name']); 
				if(move_uploaded_file($_FILES['archivo-a-subir']['tmp_name'], $target_path)) 
				{
                    $epago=3;
					$b = new MvcController();
					$b -> crearPagoController($idusuario, $_POST["referenciaPago"], $epago, $_POST["conceptoPago"], $_POST["importePago"], $strimg, $_POST["mensajePago"]);
				} 
				else
				{ 
				echo "Hubo un error al subir tu archivo! Por favor intenta de nuevo."; 
				}
		}
			else
			{
			 echo "Imagen inválida";
			}
		
	}else{
  
    }
 ?>


		<div class="panel panel-default">
                        <div class="panel-heading">
                            Crear nuevo pago
                        </div>
                        <div class="panel-body">
							<form role="form" enctype="multipart/form-data" method="post" autocomplete="off">
							<input type="hidden" name="MAX_FILE_SIZE" value="9250000000" /> 
                            <div class="row">
                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Concepto</label>
                                            <select name="conceptoPago" class="form-control selectpicker" data-live-search="true"name>
                                                
                                                <?php 
                                                /*$a = new MvcController;
                                                $a -> conceptosController();*/
                                                $mes=date("n"); 
                                                  $rango=6; 
                                                  for ($i=$mes;$i<=$mes+$rango;$i++){ 
                                                    
                                                     $meses=date('F', mktime(0, 0, 0, $i, 1, date("Y") ) );
                                                     if ($meses=="January") $mes="Enero";
                                                    if ($meses=="February") $mes="Febrero";
                                                    if ($meses=="March") $meses="Marzo";
                                                    if ($meses=="April") $meses="Abril";
                                                    if ($meses=="May") $meses="Mayo";
                                                    if ($meses=="June") $meses="Junio";
                                                    if ($meses=="July") $meses="Julio";
                                                    if ($meses=="August") $meses="Agosto";
                                                    if ($meses=="September") $meses="Setiembre";
                                                    if ($meses=="October") $meses="Octubre";
                                                    if ($meses=="November") $meses="Noviembre";
                                                    if ($meses=="December") $meses="Diciembre";
                                                     $ano=date('Y', mktime(0, 0, 0, $i, 1, date("Y") ) );
                                                     echo "<option value='$meses $ano'>$meses $ano</option>"; 
                                                  } 
                                                ?>
                                            </select>
                                        </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-4">
	                                <div class="form-group">
	                                    <label>Referencia</label>
	                                    <input name="referenciaPago" placeholder="OXXO: 12345678" class="form-control" required>
	                                </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Importe</label>
                                        <input type="number" name="importePago" class="form-control" placeholder="$" required>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>

                            <div class="row">
                            <div clas="row"><div class="col-lg-12">
                           	<div class="form-group">
                                    <label>Comprobante:</label>
                                    <input name="archivo-a-subir" type="file" required>
                             </div></div>
                            </div>
                            	<div class="col-lg-12">
                            		<div class="form-group">
                                            <label>Mensaje</label>
                                            <textarea  name="mensajePago" id="redactor" class="form-control" rows="3"></textarea required>

                                            

                                        </div>
                            	</div>
                            </div>
                            <!-- /.row (nested) -->
                             <button type="sumbit" class="btn btn-primary">Enviar mensaje</button>
                             <a href="panel.php?modulo=pagos"><button type="button" class="btn btn-danger">Cancelar</button></a>
                             </form>
                        </div>

                        <!-- /.panel-body -->
                    </div>



