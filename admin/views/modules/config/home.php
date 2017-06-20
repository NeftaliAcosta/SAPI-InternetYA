<?php 
        $esistema= "";
        $nsistema= "";
        $txtaviso= "";
        $txtbancarios = "";

    if(isset($_POST["ntickets"]) || isset($_POST["npagos"]) || isset($_POST["ncliente"]) || isset($_POST["naviso"]) || isset($_POST["esistema"]) || isset($_POST["nsistema"]) || isset($_POST["txtaviso"]) || isset($_POST["txtaviso"]) || isset($_POST["txtbancarios"]) ){

        if($_POST["ntickets"]==NULL){
            $ntickets=0;
        }else{
            $ntickets=1;
        }
        if($_POST["npagos"]==NULL){
            $npagos=0;
        }else{
            $npagos=1;
        }
        if($_POST["ncliente"]==NULL){
            $ncliente=0;
        }else{
            $ncliente=1;
        }
        if($_POST["naviso"]==NULL){
            $naviso=0;
        }else{
            $naviso=1;
        }
        $esistema= $_POST["esistema"];
        $nsistema= $_POST["nsistema"];
        $txtaviso= $_POST["txtaviso"];
        $txtbancarios = $_POST["txtbancarios"];


        $datos = ["ntickets" => $ntickets, "npagos" => $npagos, "nclientes" => $ncliente, "naviso" => $naviso, "esistema" => $esistema, "nsistema" => $nsistema, "txtaviso"=> $txtaviso, "txtbancarios" => $txtbancarios];
        $w = new MvcController();
        $w -> actualizarSistemacontroller($datos);
    }else{
        $a = new MvcController();
        $a -> sistemaController();
    }
        
?>



