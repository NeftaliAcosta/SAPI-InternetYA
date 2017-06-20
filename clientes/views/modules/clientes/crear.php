    <?php 
        $a = new MvcController();
        $a -> crearUsuarioController();
    ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Nuevo Usuario
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                 <form role="form" method="post" autocomplete="off">
                                    <div class="col-lg-4">                                
                                        <div class="form-group">
                                            <label>*Usuario</label>
                                            <input name="usuarioCrear" class="form-control" required tabindex="1">
                                            <p class="help-block">Solo acepta minúsculas.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*Nombre</label>
                                            <input type="text" name="nombreCrear" class="form-control" required tabindex="4">
                                            <p class="help-block">Ingresa el/los nombre(s) del cliente.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*E-mail</label>
                                            <input type="email" name="emailCrear" class="form-control" required tabindex="7">
                                            <p class="help-block">Correo del cliente.</p>
                                        </div>
                                         <div class="form-group">
                                            <label>Localidad</label>
                                            <select name="localidadCrear" class="form-control selectpicker" tabindex="10" data-live-search="true"name>
                                                <?php 
                                                    $a = new MvcController();
                                                    $a -> llenarFormLocalidadesController();
                                                ?>
                                            </select>
                                        </div>
                                      
                                       

                                        
                                    
                                  
                                </div>

                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>*Contraseña</label>
                                            <input type="password" name="passwordCrear" class="form-control" required tabindex="2">
                                            <p class="help-block">Ingresa una contraseña segura.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>*Apellido Paterno</label>
                                            <input type="text" name="apellido1Crear" class="form-control" required tabindex="5">
                                            <p class="help-block">Solo el apellido paterno.</p>
                                        </div>
                                         <div class="form-group">
                                            <label>*Dirección</label>
                                            <input type="text" name="direccionCrear" class="form-control" required tabindex="8">
                                            <p class="help-block">Calle, Número, Colonia, CP.</p>
                                        </div>
                                          <div class="form-group">
                                            <label>*Whhatsapp</label>
                                            <input type="number" name="telefonoCrear" class="form-control" required tabindex="11">
                                            <p class="help-block">Teléfono o Whatsapp del cliente</p>
                                        </div>

                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                            <label>Privilegio</label>
                                            <select name="privilegioCrear" class="form-control" tabindex="3">
                                                <option value="1">Cliente</option>
                                                <option value="0">Administrador</option>
                                            </select>
                                            <p class="help-block">Elige correctamente el privilegio.</p>
                                        </div>
                                    <div class="form-group">
                                            <label>Apellido Materno</label>
                                            <input type="text" name="apellido2Crear" class="form-control" tabindex="6">
                                            <p class="help-block">Este apellido es opcional.</p>
                                        </div>
                                    <div class="form-group">
                                            <label>Referencia</label>
                                            <input type="text" name="referenciaCrear" class="form-control" required tabindex="9">
                                            <p class="help-block">Alguna referencia para identificar al cliente.</p>
                                        </div>
                                        <div class="form-group" tabindex="13">
                                            <label>Fecha de Corte</label>
                                            <?php 
                                                $a -> llenarFormFechaCortesController();
                                            ?>
                                        </div>
                                   

                                        
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <button type="submit" class="btn btn-primary pull-left mybtn">Crear Cliente</button>

                                <a href="panel.php?modulo=clientes&action=home"><button type="button" class="btn btn-danger pull-left mybtn">Cancelar</button></a>

                                </form>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


