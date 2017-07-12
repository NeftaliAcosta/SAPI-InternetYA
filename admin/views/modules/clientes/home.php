                   <a href="panel.php?modulo=clientes&action=crear"><button type="button" class="btn btn-primary">Crear Cliente</button></a><br><br>
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            Clientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                             <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables" >
                                    <thead>
                                        <tr>
                                            <th>ID Cliente</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Dirección</th>
                                            <th>Referencia</th>
                                         
                                            <th>Localidad</th>
                                            <th>Corte</th>
                                            <th>Ver/Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php
                                    $idusuario =  $_SESSION["id"];
                                    $vistaUsuario = new MvcController();
                                    $vistaUsuario -> verUsuarioController($idusuario);

                                ?> 	
                                </tbody>


                            </table>
                            </div></div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->