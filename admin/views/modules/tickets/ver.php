                   

<?php 
    if(isset( $_GET['id'])){
        $id=$_GET['id'];

        $datosticket = Datos::obtenerTicketModel($id);
        #var_dump($datosticket);
        if($datosticket[0]== 0){
            echo '
        <div class="alert alert-danger">
            El ticket no existe en el sistema.
         </div>
            ';
        }else{
            if($datosticket["estado"]==1){
                $estado="Abierto";
            }else{
                $estado="Cerrado";
                }
            if($datosticket["prioridad"]==1){
                $prioridad = "Baja";
                }elseif($datosticket["prioridad"]==2){
                    $prioridad = "Media";
                }elseif($datosticket["prioridad"]==3){
                    $prioridad = "Alta";
                }

            echo '
            <div class="panel panel-primary">
                        <div class="panel-heading">
                            Seguimiento de Ticket
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="disabledSelect">ID Ticket</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="'.$datosticket["id"].'" disabled="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="disabledSelect">Nombre</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="'.$datosticket["nombre"]. ' '.$datosticket["apellido1"].'" disabled="">
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="disabledSelect">Asunto</label>
                                        <input class="form-control" name="asuntoTicket" id="disabledInput" type="text" placeholder="'.$datosticket["asunto"]. '" disabled="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="disabledSelect">Prioridad</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="'.$prioridad. '" disabled="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="disabledSelect">Fecha</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="'.$datosticket["fecha"].'" disabled="">
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="disabledSelect">Estado</label>
                                        <input class="form-control" id="disabledInput" type="text" placeholder="'. $estado.'" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4>Conversación </h4>



            ';


            $a = new MvcController();
            $a -> resummenTicketcontroller($id, $datosticket["estado"]);
        }




         if(isset($_POST["respuesta"])){
            $idticket=$id;
            $idusuario =$_SESSION["id"];
            $mensaje = $_POST["respuesta"];
            $clase=1;
            $instancia = new MvcController();
            $instancia -> mensajeTicketController($idticket, $idusuario,  $mensaje, $clase);

        }
        
    }




 ?>
