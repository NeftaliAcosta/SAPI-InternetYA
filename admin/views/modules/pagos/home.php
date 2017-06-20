    <a href="panel.php?modulo=pagos&action=crear"><button type="button" class="btn btn-primary">Crear Pago</button></a><br><br>

    <div class="panel panel-default">
                        <div class="panel-heading">
                           Pagos Pendientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!--<div class="table-responsive" >-->
                                 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables"  >
                                    <thead>
                                        <tr>
                                            <th>ID Cliente</th>
                                            <th>Nombre</th>
                                            <th>Fecha</th>
                                            <th>Referencia</th>
                                            <th>Estado</th>
                                            <th>Concepto</th>
                                            <th>Importe</th>
                                            <th>Ver/Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
										    $a = new MvcController();
										    $a -> pagosPendientesController();
										?>
                                    </tbody>
                                </table>
                           <!-- </div>-->
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->