    
<a href="panel.php?modulo=tickets&action=crear"><button type="button" class="btn btn-primary">Crear Ticket</button></a></br></br>
    <div class="panel panel-default">
                        <div class="panel-heading">
                           Tickets de Soporte
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" >
                                 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables"  >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Prioridad</th>
                                            <th>Asunto</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Ver/Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                            $idusuario = $_SESSION["id"];  
										    $a = new MvcController();
										    $a -> obtenerTicketsController($idusuario);
										?>
                                    </tbody>
                                </table>
                           </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->