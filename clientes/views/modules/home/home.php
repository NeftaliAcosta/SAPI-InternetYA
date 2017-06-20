<h3>Bienvenid@ apreciable cliente.</h3>

<?php
    $r = Datos::detalleSistema();
    if($r["nAviso"]==1){
        echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                '.$r["txtAviso"].' 
            </div>';
    } 
 ?>

<?php 

    
        $idusuario = $_SESSION["id"];
            if(isset($_POST["passwordActualizar"])){
				$mypassword = Datos::encriptar($_POST["passwordActualizar"]);
				$nTelefono = $_POST["telefonoActualizar"];

        $datos = ["id" => $idusuario, "password" => $mypassword, "telefono" => $nTelefono];

        $w = new MvcController();
        $w -> actualizarUsuarioController($datos);
    }
       


       
                $respuesta = Datos::validarID($idusuario);
                $id=$respuesta["ID"];

                if($respuesta >0){

                     $detalleusuario = new MvcController();
                     $detalleusuario -> verUsuarioCompletoController($respuesta);

                }else{
                    echo '<div class="alert alert-danger">
                                El usuario al que intentas acceder no existe en el sistema.
                            </div>'
                            ;
                }
 
    

 ?>



