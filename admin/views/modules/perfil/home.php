<h3>Mi perfil</h3>
<?php 
    if(isset($_SESSION["id"])){
        $respuesta = Datos::validarID($_SESSION["id"]);
        $id=$respuesta["ID"];
            if($respuesta >0){
                $detalleusuario = new MvcController();
                $detalleusuario -> verPerfilController($respuesta);
            }else{
                echo '<div class="alert alert-danger">
                        El usuario al que intentas acceder no existe en el sistema.
                        </div>
                    <a href="panel.php?modulo=clientes&action=crear"<button type="button" class="btn btn-primary">Creear Cliente</button></a>'
                ;
                }
            }


    if(isset($_POST["estadoActualizar"])){
        $estado = mysql_real_escape_string($_POST["estadoActualizar"]);
        $password = Datos::encriptar(mysql_real_escape_string($_POST["passwordActualizar"]));
        $nNombre = mysql_real_escape_string($_POST["nombreActualizar"]);
        $nApellido1 = mysql_real_escape_string($_POST["apellido1Actualizar"]);
        $nApellido2 = mysql_real_escape_string($_POST["apellido2Actualizar"]);
        $nEmail =mysql_real_escape_string($_POST["emailActualizar"]);
        $nDireccion = mysql_real_escape_string($_POST["direccionActualizar"]);
        $nReferencia = mysql_real_escape_string($_POST["referenciaActualizar"]);
        $nLocalidad = mysql_real_escape_string($_POST["localidadActualizar"]);
        $nTelefono = mysql_real_escape_string($_POST["telefonoActualizar"]);
        $nCorte = mysql_real_escape_string($_POST["corteActualizar"]);

        $datos = ["id" => $id, "password" => $password, "estado"=>$estado ,"nombre" => $nNombre, "apellido1" => $nApellido1, "apellido2" => $nApellido2, "email" => $nEmail, "direccion" => $nDireccion, "referencia" => $nReferencia, "localidad" => $nLocalidad, "telefono" => $nTelefono, "corte" => $nCorte ];

        $w = new MvcController();
        $w -> actualizarUsuarioController($datos);
    }
        
    

