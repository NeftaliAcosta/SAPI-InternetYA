<h3>Mi perfil</h3>

<?php 
    if(isset($_SESSION["id"])){
                $idencriptada = Datos::encriptar($_SESSION["id"]);
                $respuesta = Datos::validarID($idencriptada);
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
        $estado = $_POST["estadoActualizar"];
        $password = Datos::encriptar($_POST["passwordActualizar"]);
        $nNombre = $_POST["nombreActualizar"];
        $nApellido1 = $_POST["apellido1Actualizar"];
        $nApellido2 = $_POST["apellido2Actualizar"];
        $nEmail = $_POST["emailActualizar"];
        $nDireccion = $_POST["direccionActualizar"];
        $nReferencia = $_POST["referenciaActualizar"];
        $nLocalidad = $_POST["localidadActualizar"];
        $nTelefono = $_POST["telefonoActualizar"];
        $nCorte = $_POST["corteActualizar"];

        $datos = ["id" => $id, "password" => $password, "estado"=>$estado ,"nombre" => $nNombre, "apellido1" => $nApellido1, "apellido2" => $nApellido2, "email" => $nEmail, "direccion" => $nDireccion, "referencia" => $nReferencia, "localidad" => $nLocalidad, "telefono" => $nTelefono, "corte" => $nCorte ];

        $w = new MvcController();
        $w -> actualizarUsuarioController($datos);
    }
        
    

 ?>


