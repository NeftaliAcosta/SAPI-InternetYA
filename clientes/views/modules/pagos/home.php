    <a href="panel.php?modulo=pagos&action=crear"><button type="button" class="btn btn-primary">Enviar Pago</button></a>
    <a href="#"><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#ModalBancarios">Detalles Bancarios</button></a>
    <br><br>



    <div class="panel panel-default">
                        <div class="panel-heading">
                           Pagos Pendientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" >
                                 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables"  >
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha</th>
                                            <th>Referencia</th>
                                            <th>Estado</th>
                                            <th>Concepto</th>
                                            <th>Importe</th>
                                            <th>Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                            $idusuario = $_SESSION["id"];
										    $a = new MvcController();
										    $a -> pagosPendientesController($idusuario);
										?>
                                    </tbody>
                                </table>
                           </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->