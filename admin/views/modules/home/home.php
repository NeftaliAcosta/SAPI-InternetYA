<?php 
    if(isset($_SESSION["id"])){
        $id = Datos::encriptar($_SESSION["id"]);
        $r = Datos::validarID($id);
        echo '<h3> Bienvenid@ '.$r["Nombre"] . ' '.$r["Apellido1"].'</h3>';
    } 
    $a = new MvcController();
    $a -> estadisticaController();

?>

    <div class="panel panel-default">
                        <div class="panel-heading">
                           Pagos Recientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!--<div class="table-responsive" >-->
                                 <table width="100%" class="table table-striped table-bordered table-hover"  >
                                    <thead>
                                        <tr>
											<th>ID </th>
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
										    $a = new MvcController();
										    $a -> pagosRecientesController();
										?>
                                    </tbody>
                                </table>
                           <!-- </div>-->
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->



