    <div class="panel panel-default">
                        <div class="panel-heading">
                           Pagos Pendientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!--<div class="table-responsive">-->
                                <table class="table table-striped table-bordered table-hover" id="dataTables" >
                                    <thead>
                                        <tr>
                                            <th>ID Cliente</th>
                                            <th>Nombre</th>
                                            <th>Fecha de pago</th>
                                            <th>Referencia</th>
                                            <th>Estado</th>
                                            <th>Concepto</th>
                                            <th>Importe</th>
                                            <th>Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
										    $a = new MvcController();
										    $a -> pagosRealizadosController();
										?>
                                    </tbody>
                                </table>
                            <!--</div>-->
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
